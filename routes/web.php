<?php

use App\Http\Controllers\channelController;
use App\Http\Controllers\ecmController;
use App\Http\Controllers\hmpController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\larController;
use App\Http\Controllers\ratingController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\roomController;
use App\Http\Controllers\roomfeedbackController;
use App\Http\Controllers\roommantenanceController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\userController;
use App\Models\AuditTrails;
use App\Models\Channel;
use App\Models\DeptAccount;
use App\Models\DeptLogs;
use App\Models\Ecm;
use App\Models\Guest;
use App\Models\guestRatings;
use App\Models\Hmp;
use App\Models\Inventory;
use App\Models\room;
use App\Models\Lar;
use App\Models\room_maintenance;
use App\Models\roomfeedbacks;
use App\Models\stockRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// security for guest
function guestAuthCheck() {
    if (!Auth::guard('guest')->check()) {
        return redirect('/restrictedguest')->send(); // stop execution and redirect
    }
}

function employeeAuthCheck() {
    if (!Auth::check()) {
        return redirect('/restrictedemployee')->send(); // stop execution and redirect
    }
}
function employeeOtpCheck() {
    if (!Session::has('pending_employee_id')) {
        return redirect('/restrictedemployee')->send();
    }
}


// 



Route::get('/', function () {
    $rooms = Room::all();
    $ratingcomments = GuestRatings::all();

    // Ratings summary
    $averageRating   = GuestRatings::avg('rating_rating');
    $totalReviews    = GuestRatings::count();
    $recommendRate   = GuestRatings::where('rating_rating', '>=', 4)->count();
    $recommendRate   = $totalReviews > 0 
                        ? round(($recommendRate / $totalReviews) * 100) 
                        : 0;

    // Fetch promos and events
    $promos = Hmp::where('hotelpromostatus', 'Active')->get();
    $events = Ecm::where('eventstatus', 'Approved')->get();

    $promoCount = $promos->count();
    $eventCount = $events->count();

    return view('index', compact(
        'rooms',
        'ratingcomments',
        'averageRating',
        'totalReviews',
        'recommendRate',
        'promos',
        'events',
        'promoCount',
        'eventCount',
    ));
});


Route::post('/landingrating', [ratingController::class, 'store']);

// booking via landing

Route::get('/bookinglanding', function(){
    return view('booking.booking');
});

Route::get('/selectedroom/{roomID}', [landingController::class, 'selectedroom']);
Route::get('/bookconfirmlanding/{roomID}', [landingController::class, 'bookconfirmlanding']);
Route::post('/guestcreatereservationlanding', [landingController::class, 'storereservation']);

Route::get('/booking/success/{id}', function($id) {
    $reservation = Reservation::findOrFail($id);
    $roomprice = Room::where('roomID', $reservation->roomID)->value('roomprice');
    $roomtype  = Room::where('roomID', $reservation->roomID)->value('roomtype');

    return view('booking.bookingsuccess', compact('reservation', 'roomprice', 'roomtype'));
})->name('booking.success');

// Login 
Route::get('/employeelogin', function(){
    return view('employeelogin.login');
});
// guest
Route::post('/guestloginform', [userController::class, 'guestlogin']);
Route::get('/loginguest', function(){
    return view('guestlogin.login');
});
Route::get('/guestloginotp', function(){
    return view('guestlogin.guestotp');
});
Route::post('/verifyguestotp', [userController::class, 'verifyGuestOTP']);
Route::post('/resendguestotp', [userController::class, 'resendGuestOtp'])->name('resendguest.otp');
// Register
Route::get('/guestregister', function(){
    return view('guestregister.register');
});

// 401 page

// guest 401
Route::get('/restrictedguest', function(){
    return view('401.guesterror');
});
Route::get('/restrictedemployee', function(){
    return view('401.employeeerror');
});


// Admins

// dashboard

Route::get('/employeedashboard', function() {
    employeeAuthCheck();

    // === Reservations ===
    $totalreservation = Reservation::count();

    $reservationThisWeek = Reservation::whereBetween('created_at', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek()
    ])->count();

    $reservationLastWeek = Reservation::whereBetween('created_at', [
        Carbon::now()->subWeek()->startOfWeek(),
        Carbon::now()->subWeek()->endOfWeek()
    ])->count();

    $reservationLastMonth = Reservation::whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', Carbon::now()->subMonth()->year)
        ->count();

    $reservationThisMonth = Reservation::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

    // === Rooms ===
    $totalrooms = Room::count();
    $needmaintenance = Room_Maintenance::count();

    // === Employees / Guests ===
    $totalemployees = DeptAccount::where('status', 'Active')->count();
    $guestacccount = Guest::count();

    // === Markets / Channels ===
    $roommarkets = Hmp::count();
    $channellisting = Channel::where('channelStatus', 'Approved')->count();

    // === Marketing / Loyalty / Events ===
    $activecampaigns = Hmp::count();
    $loyaltyandrewards = Lar::count();
    $totalevents = Ecm::count();

    // Revenu 

      $today = now();
    $currentMonth = $today->month;
    $currentYear  = $today->year;

    $lastMonthDate = $today->copy()->subMonth();
    $lastMonth = $lastMonthDate->month;
    $lastMonthYear = $lastMonthDate->year;

    $calculateRevenue = function($month, $year) {
        return Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->where('core1_reservation.payment_status', 'Paid')
            ->whereMonth('core1_reservation.reservation_checkin', $month)
            ->whereYear('core1_reservation.reservation_checkin', $year)
            ->get()
            ->sum(function ($reservation) {
                $nights = Carbon::parse($reservation->reservation_checkin)
                    ->diffInDays(Carbon::parse($reservation->reservation_checkout));
                $base = $reservation->roomprice * $nights;
                return $base + ($base * 0.12) + ($base * 0.02);
            });
    };

     

    $revenueCurrent = $calculateRevenue($currentMonth, $currentYear);
    $revenueLast    = $calculateRevenue($lastMonth, $lastMonthYear);
    $revenueChange  = $revenueLast > 0 ? (($revenueCurrent - $revenueLast) / $revenueLast) * 100 : 0;


     $calculateNights = function($month, $year) {
        return Reservation::where('payment_status', 'Paid')
            ->whereMonth('reservation_checkin', $month)
            ->whereYear('reservation_checkin', $year)
            ->get()
            ->sum(function ($r) {
                return Carbon::parse($r->reservation_checkin)
                    ->diffInDays(Carbon::parse($r->reservation_checkout));
            });
    };

    $nightsCurrent = $calculateNights($currentMonth, $currentYear);
    $nightsLast    = $calculateNights($lastMonth, $lastMonthYear);

    // Avg Daily Rate
    $avgDailyRateCurrent = $nightsCurrent > 0 ? $revenueCurrent / $nightsCurrent : 0;
    $avgDailyRateLast    = $nightsLast > 0 ? $calculateRevenue($lastMonth, $lastMonthYear) / $nightsLast : 0;
    $avgDailyRateChange  = $avgDailyRateLast > 0 ? (($avgDailyRateCurrent - $avgDailyRateLast) / $avgDailyRateLast) * 100 : 0;

    // RevPAR
    $totalRooms = Room::count();
    $daysCurrent = Carbon::now()->daysInMonth;
    $daysLast = $lastMonthDate->daysInMonth;
    $availableRoomNightsCurrent = $totalRooms * $daysCurrent;
    $availableRoomNightsLast    = $totalRooms * $daysLast;

    $revPARCurrent = $availableRoomNightsCurrent > 0 ? $revenueCurrent / $availableRoomNightsCurrent : 0;
    $revPARLast    = $availableRoomNightsLast > 0 ? $revenueLast / $availableRoomNightsLast : 0;
    $revPARChange  = $revPARLast > 0 ? (($revPARCurrent - $revPARLast) / $revPARLast) * 100 : 0;

    // Occupancy Rate
    $occupancyCurrent = $availableRoomNightsCurrent > 0 ? ($nightsCurrent / $availableRoomNightsCurrent) * 100 : 0;
    $occupancyLast    = $availableRoomNightsLast > 0 ? ($nightsLast / $availableRoomNightsLast) * 100 : 0;
    $occupancyChange  = $occupancyLast > 0 ? ($occupancyCurrent - $occupancyLast) / $occupancyLast * 100 : 0;

       $last30DaysLabels = [];
    $revenueLast30Days = [];
    $avgDailyRateLast30Days = [];
    $revPARLast30Days = [];
    $occupancyLast30Days = [];

    $totalRooms = Room::count();

    for ($i = 29; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i);
        $last30DaysLabels[] = $date->format('M d'); // e.g. "Aug 28"

        // Revenue for this day
        $dailyRevenue = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
            ->where('core1_reservation.payment_status', 'Paid')
            ->whereDate('core1_reservation.reservation_checkin', $date)
            ->get()
            ->sum(function ($reservation) {
                $nights = Carbon::parse($reservation->reservation_checkin)
                    ->diffInDays(Carbon::parse($reservation->reservation_checkout));
                $base = $reservation->roomprice * $nights;
                return $base + ($base * 0.12) + ($base * 0.02);
            });

        $revenueLast30Days[] = $dailyRevenue;

        // Avg Daily Rate
        $dailyNights = Reservation::where('payment_status', 'Paid')
            ->whereDate('reservation_checkin', $date)
            ->get()
            ->sum(function ($r) {
                return Carbon::parse($r->reservation_checkin)
                    ->diffInDays(Carbon::parse($r->reservation_checkout));
            });
        $avgDailyRateLast30Days[] = $dailyNights > 0 ? $dailyRevenue / $dailyNights : 0;

        // RevPAR
        $revPARLast30Days[] = $totalRooms > 0 ? $dailyRevenue / $totalRooms : 0;

        // Occupancy Rate
        $occupancyLast30Days[] = $totalRooms > 0 ? ($dailyNights / $totalRooms) * 100 : 0;
    }



    // === Calculations for comparisons ===
    $reservationGrowthMonth = $reservationLastMonth > 0
        ? (($reservationThisMonth - $reservationLastMonth) / $reservationLastMonth) * 100
        : 0;

    $reservationGrowthWeek = $reservationLastWeek > 0
        ? (($reservationThisWeek - $reservationLastWeek) / $reservationLastWeek) * 100
        : 0;

    $maintenanceRate = $totalrooms > 0
        ? ($needmaintenance / $totalrooms) * 100
        : 0;

    $occupancyRate = $totalrooms > 0
        ? ($totalreservation / $totalrooms) * 100
        : 0;

    // === Reservations last 7 days (graph) ===
    $reservationsLast7Days = Reservation::select(
        DB::raw('DATE(created_at) as date'),
        DB::raw('COUNT(*) as count')
    )
    ->where('created_at', '>=', Carbon::now()->subDays(6))
    ->groupBy('date')
    ->orderBy('date', 'asc')
    ->get();

    // === Events per month (graph) ===
    $eventsByMonth = Ecm::select(
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as count')
    )
    ->whereYear('created_at', Carbon::now()->year)
    ->groupBy('month')
    ->orderBy('month')
    ->get();

    return view('admin.dashboard', compact(
        'totalreservation',
        'reservationThisWeek',
        'reservationLastWeek',
        'reservationGrowthWeek',
        'reservationGrowthMonth',
        'totalrooms',
        'needmaintenance',
        'maintenanceRate',
        'occupancyRate',
        'totalemployees',
        'guestacccount',
        'roommarkets',
        'channellisting',
        'activecampaigns',
        'loyaltyandrewards',
        'totalevents',
        'reservationsLast7Days',
        'eventsByMonth',
          'revenueCurrent', 
          'revenueChange',
        'avgDailyRateCurrent', 
        'avgDailyRateChange',
        'revPARCurrent',
         'revPARChange',
        'occupancyCurrent', 
        'occupancyChange',
          'last30DaysLabels',
        'revenueLast30Days',
        'avgDailyRateLast30Days',
        'revPARLast30Days',
        'occupancyLast30Days'
    ));
});

Route::get('/departmentaccount', function(){
     employeeAuthCheck();
    $employee = DeptAccount::all();
    $totalemployee = DeptAccount::count();
    $activeemployee = DeptAccount::where('status', 'Active')->count();
   $inactiveemployee = DeptAccount::where('status', '!=', 'Active')->count();
    return view('admin.departmentaccount', compact(
        'employee', 'totalemployee', 'activeemployee', 'inactiveemployee'));
});

Route::get('/guestaccount', function(){
     employeeAuthCheck();
    $guest = Guest::paginate(5); // 10 guests per page
    $totalguest = Guest::count();
    $checkinguest = Reservation::where('reservation_bookingstatus', 'Checked in')->count();
    $pendingguest = Reservation::where('reservation_bookingstatus', 'Pending')->count();

    return view('admin.guestaccount', compact('guest', 'checkinguest', 'pendingguest', 'totalguest'));
});

Route::get('/departmentlogs', function (Request $request) {
    employeeAuthCheck();

    $query = DeptLogs::query();

    // 🔎 Filtering
    if ($request->filled('status')) {
        $query->where('log_status', $request->status);
    }
    if ($request->filled('type')) {
        $query->where('log_type', $request->type);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('employee_name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%")
              ->orWhere('dept_id', 'like', "%{$search}%");
        });
    }

    // 📄 Pagination (10 per page)
    $deptlogs = $query->orderByDesc('date')->paginate(10)->withQueryString();
    $totallogs = deptlogs::count();
    $successfullogs = deptlogs::where('log_status', 'Success')->count();
    $failedlogs = deptlogs::where('log_status', 'Failed')->count();
    

    return view('admin.deptlogs', compact('deptlogs', 
    'totallogs', 'successfullogs', 'failedlogs'));
});

Route::get('/audittrails', function (Request $request) {
    $query = AuditTrails::query();



    // 🔍 Search by employee_name or employee_id
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('employee_name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%")
              ->orWhere('modules_cover', 'like', "%{$search}%");
        });
    }

    // 📂 Filter by module
    if ($request->filled('filter')) {
        $query->where('modules_cover', $request->filter);
    }

    // 📅 Order by custom `date` column
    $audittrails = $query->orderBy('date', 'desc')
        ->paginate(10)
        ->appends($request->only('filter', 'search'));

    $categories = [
        'Channel Management',
        'Event And Conference',
        'Hotel Marketing And Promotion',
        'Inventory And Stocks',
        'Housekeeping And Maintenance',
        'Room Management And Service',
        'Booking And Reservation',
        'Front Desk And Reception',
    ];

      // 📊 Counts per module
    $moduleCounts = AuditTrails::select('modules_cover', DB::raw('COUNT(*) as total'))
        ->groupBy('modules_cover')
        ->pluck('total', 'modules_cover');

    // 📊 Total logs
    $totalLogs = AuditTrails::count();

    return view('admin.audittrails', compact('audittrails', 'categories', 'moduleCounts', 'totalLogs'));
});
Route::get('/hmp', function(){
    employeeAuthCheck();
    $hmpdata = Hmp::latest()->get();
     $events = Ecm::where('eventstatus', 'Approved')->latest()->get();
      $rooms = room::where('roomstatus', 'Available')->latest()->get();

    return view('admin.hmp', ['hmpdata' => $hmpdata, 'rooms' => $rooms, 'events' => $events]);
});
Route::post('/createhmp', [hmpController::class, 'createhmp']);
Route::get('/searchhmp', [hmpController::class, 'index']);
Route::put('/edithmp/{promoID}', [hmpController::class, 'edithmp']);
Route::delete('/deletehmp/{promoID}', [hmpController::class, 'deletehmp']);

// events and conference module
Route::get('/ecm', function(){
     employeeAuthCheck();
    $events = Ecm::latest()->get();
    $totalevents = Ecm::count();
    $approvedevents = Ecm::where('eventstatus', 'Approved')->count();
    $cancelledevents = Ecm::where('eventstatus', 'cancelled')->count();
    return view('admin.ecm', ['events' => $events, 'totalevents' => 
    $totalevents, 'approvedevents' => $approvedevents, 'cancelledevents' => $cancelledevents]);
});
Route::post('/createecm', [ecmController::class, 'store']);
Route::put('/editecm/{eventID}', [ecmController::class, 'update']);
Route::delete('/deleteecm/{eventID}', [ecmController::class, 'delete']);
Route::put('/approveecm/{eventID}', [ecmController::class, 'approved']);
Route::put('/cancelecm/{eventID}', [ecmController::class, 'cancel']);

Route::get('/roommanagement', function(Request $request) {
     employeeAuthCheck();
    $totalrooms = Room::count();
    $occupiedrooms = Room::where('roomstatus', 'Occupied')->count();
    $availablerooms = Room::where('roomstatus', 'Available')->count();
    $maintenancerooms = Room::where('roomstatus', 'Maintenance')->count();
    $reservedrooms = Room::where('roomstatus', 'Reserved')->count();

    $rooms = Room::when($request->status, function($query) use ($request) {
                return $query->where('roomstatus', $request->status);
            })
            ->when($request->category, function($query) use ($request) {
                return $query->where('roomtype', $request->category);
            })
            ->when($request->search, function($query) use ($request) {
                return $query->where('roomID', 'like', '%'.$request->search.'%')
                           ->orWhere('roomfeatures', 'like', '%'.$request->search.'%');
            })
            ->latest()
            ->paginate(6)
            ->appends($request->query()); // Preserve all query parameters

    return view('admin.roomanagement', [
        'rooms' => $rooms, 
        'occupiedrooms' => $occupiedrooms,
        'availablerooms' => $availablerooms,
        'maintenancerooms' => $maintenancerooms,
        'reservedrooms' => $reservedrooms,
        'totalrooms' => $totalrooms
    ]);
});
// FOR AI
Route::post('/processRoomPrompt', [RoomController::class, 'processRoomPrompt']);
// 
Route::post('/createroom', [roomController::class, 'store']);
Route::put('/modifyroom/{roomID}', [roomController::class, 'modify']);
Route::delete('/deleteroom/{roomID}', [roomController::class, 'delete']);

Route::get('/gotoroom/{roomID}', [roomController::class, 'redirect']);
Route::post('/additonalroom', [roomController::class, 'addphoto']);
Route::delete('/deleteroomphoto/{roomphotoID}', [roomController::class, 'deleteroomphoto']);

// Inventory And Stocks
Route::get('/ias', function(){
     employeeAuthCheck();
    $totalItems = Inventory::count();
    $instock = Inventory::sum('core1_inventory_stocks');
    $lowstock = Inventory::whereColumn('core1_inventory_stocks', '<', 'core1_inventory_threshold')->count();
    $nostock = Inventory::where('core1_inventory_stocks', 0)->count();

    $inventory = Inventory::latest()->get();
    $stock = stockRequest::latest()->get();
    return view ('admin.ias', ['inventory' => $inventory, 'stock' => $stock, 
    'totalItems'=> $totalItems, 'instock' => $instock, 'lowstock' => $lowstock, 'nostock' => $nostock ]);
    });
Route::post('/createinventory', [inventoryController::class, 'store']);
Route::put('/updateinventory/{core1_inventoryID}', [inventoryController::class, 'modify']);
Route::delete('/deleteinventory/{core1_inventoryID}', [inventoryController::class, 'delete']);

// stocks
Route::post('/createstockrequest', [stockController::class, 'store']);
Route::put('/editstockrequest/{core1_stockID}', [stockController::class, 'modify']);
Route::delete('/deletestockrequest/{core1_stockID}', [stockController::class, 'delete']);

// Housekeeping And Maintenance 
Route::get('/hmm', function(){
     employeeAuthCheck();
      $roomID = room::where('roomstatus', '!=', 'Occupied')->where('roomstatus', '!=', 'Maintenance')->latest()->get();
      $inventory = Inventory::latest()->get();
      $rooms = room_maintenance::join('core1_room', 'core1_room.roomID', '=', 'core1_roommaintenance.roomID')
      ->latest('core1_roommaintenance.created_at')->get();
       $totalrooms = room::count();
         $maintenancerooms = room::where('roomstatus', 'Maintenance')->count();
         $urgentmaintenance = room_maintenance::where('maintenance_priority', 'Urgent')->count();
         $inventorystocks = Inventory::sum('core1_inventory_stocks'); 
          $lowstock = Inventory::whereColumn('core1_inventory_stocks', '<', 'core1_inventory_threshold')->count();
      
        return view('admin.hmm', [
            'inventory' => $inventory, 'rooms' => $rooms, 'roomID' => $roomID,
        'totalrooms' => $totalrooms, 'maintenancerooms' => $maintenancerooms, 'urgentmaintenance' => $urgentmaintenance, 'inventorystocks' => $inventorystocks, 'lowstock' => $lowstock ]);

});
Route::post('/createmaintenance', [roommantenanceController::class, 'store']);
Route::put('/updatemaintenance/{roommaintenanceID}', [roommantenanceController::class, 'modify']);
Route::put('/completemaintenance/{roommaintenanceID}', [roommantenanceController::class, 'complete']);
Route::delete('/deletemaintenance/{roommaintenanceID}', [roommantenanceController::class, 'delete']);
Route::put('usestocks/{core1_inventoryID}', [roommantenanceController::class, 'use']);

// room feedbacks
Route::get('/roomfeedback', function(){
     employeeAuthCheck();
    return view('admin.roomfeedback');
});
Route::get('/servicefeedback', function(){
     employeeAuthCheck();
    return view('admin.servicefeedback');
});


// Channel Management
Route::get('/channel', function(){
     employeeAuthCheck();
    $rooms = room::where('roomstatus', 'Available')->latest()->get();
   $channels = Channel::join('core1_room', 'core1_room.roomID', '=', 'channel_table.roomID')
    ->select('channel_table.*', 'core1_room.*', 'channel_table.created_at as createdchannel')
    ->orderBy('channel_table.created_at', 'desc')
    ->get();

    $tarastaylisting = Channel::where('channelName', 'Tarastay')->where('channelStatus', 'Approved')->count();
    $habistaylisting = Channel::where('channelName', 'Habistay')->where('channelStatus', 'Approved')->count();
    $nestscapelisting = Channel::where('channelName', 'Nestscape')->where('channelStatus', 'Approved')->count();
    return view('admin.channel', ['rooms' => $rooms, 
    'channels' => $channels, 'tarastaylisting' => $tarastaylisting,
    'habistaylisting' => $habistaylisting,
    'nestscapelisting' => $nestscapelisting ]);
}); 

Route::post('/createlisting', [channelController::class, 'store']);
Route::put('/updatelisting/{channelID}', [channelController::class, 'modify']);
Route::delete('/deletelisting/{channelID}', [channelController::class, 'delete']);

// booking and reservation
Route::get('/bas', function(){
     employeeAuthCheck();
    $rooms = room::where('roomstatus', 'Available')->latest()->get();
    $reserverooms =  Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('core1_reservation.created_at')
        ->get();
    return  view('admin.bas', ['rooms' => $rooms, 'reserverooms' => $reserverooms]);
});
Route::get('/aibas', function(){
    return view('admin.aibas');
});

Route::post('/aireserve', [reservationController::class, 'searchRooms']);

Route::post('/createreservation', [reservationController::class, 'store']);
Route::put('/modifyreservation/{reservationID}', [reservationController::class, 'modify']);
Route::delete('/deletereservation/{reservationID}', [reservationController::class, 'delete']);
// guest
Route::post('/guestcreatereservation', [reservationController::class, 'gueststore']);
 

Route::get('/reservationpage', function(){
     employeeAuthCheck();
    $rooms = room::where('roomstatus', 'Available')->latest()->get();
    return view('admin.components.bas.reservationpage', ['rooms' => $rooms]);
});

Route::get('/aiform', function(){
     employeeAuthCheck();
    return view('admin.components.bas.aiform');
});


// front desk
Route::get('/frontdesk', function(){
     employeeAuthCheck();
       $reserverooms =  Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('core1_reservation.created_at')
        ->get();
    
    return view('admin.frontdesk', ['reserverooms' => $reserverooms]);
});

Route::put('/reservationcheckin/{reservationID}', [reservationController::class, 'checkin']);
Route::put('/reservationcheckout/{reservationID}', [reservationController::class, 'checkout']);
Route::put('/reservationcancelled/{reservationID}', [reservationController::class, 'cancel']);
Route::put('/reservationconfirm/{reservationID}', [reservationController::class, 'confirm']);

// loyalty and rewards

Route::get('lar', function(){
     employeeAuthCheck();
    $rooms = room::whereNotIn('roomID', function ($query) {
    $query->select('roomID')->from('core1_loyaltyandrewards');
})->get();
    $roompoints = Lar::join('core1_room', 'core1_room.roomID', '=', 'core1_loyaltyandrewards.roomID')
    ->latest('core1_loyaltyandrewards.created_at')
    ->get();


    $totalpoints = Lar::sum('loyalty_value');
    $totalreward = Lar::count();

    return view('admin.lar', ['rooms' => $rooms, 'roompoints' => $roompoints, 'totalpoints' => $totalpoints, 'totalreward' => $totalreward]);
});
Route::post('/createlar', [larController::class, 'store']);
Route::put('/editlar/{loyaltyID}', [larController::class, 'modify']);
Route::put('/expirelar/{loyaltyID}', [larController::class, 'expired']);
Route::delete('/deletelar/{loyaltyID}', [larController::class, 'delete']);
Route::post('/guestadd/{loyaltyID}', [larController::class, 'addtoguest']);




// login site
Route::post('/loginuser', [userController::class, 'login']);


// for employee
Route::get('/employeeloginotp', function(){
    
    return view('employeelogin.loginotp');
});

Route::post('/verifyotpemployee', [UserController::class, 'verifyOTP']);
Route::post('/resendotpemployee', [userController::class, 'resendOtp'])->name('resend.otp');
// 

Route::get('auth/google', [userController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [userController::class, 'handleGoogleCallback']);

// registration
Route::get('/terms', function(){
    return view('register.terms');
});
Route::get('/register', function(){
    return view('register.register');
});

Route::get('/photoupload', function(){
    return view('register.photoupload');
});

Route::post('/registerguest', [userController::class, 'create']);

Route::put('/upload-photo/{guestID}', [userController::class, 'profilesetup']);



// logout
// employee
Route::get('/employeelogout', [userController::class, 'logout']);

// guest
Route::get('/guestlogout', [userController::class, 'guestlogout']);

// Print receipt
Route::get('/printreceipt/{reservationID}', [reservationController::class, 'generateInvoice']);



Route::get('/guestdashboard', function() {
    guestAuthCheck();

    $guestID = Auth::guard('guest')->user()->guestID;

    // Total reservations
    $guesttotalreservation = Reservation::where('guestID', $guestID)->count();

    // Total reservations last month (for comparison)
    $previousReservations = Reservation::where('guestID', $guestID)
        ->whereMonth('created_at', now()->subMonth()->month)
        ->count();

    // Recent stay
    $recentstay = Reservation::where('guestID', $guestID)
        ->orderBy('reservation_checkin', 'desc')
        ->first();

    // Favorite room (most booked by guest)
     $favoriteroomID = Reservation::select('roomID')
        ->where('guestID', $guestID)
        ->groupBy('roomID')
        ->orderByRaw('COUNT(roomID) DESC')
        ->pluck('roomID')
        ->first();

    $favoriteroom = $favoriteroomID ? Room::find($favoriteroomID) : null;

    $rooms = room::all();

    $events = ecm::all();

    $promos = Hmp::all();

    return view('guest.dashboard', compact(
        'guesttotalreservation',
        'previousReservations',
        'recentstay',
        'favoriteroom',
        'events',
        'rooms',
        'promos',
    ));
});

// Guest
Route::get('/showrooms', function(){
     guestAuthCheck();
    return view('guest.rooms');
});

Route::get('/roomdetails/{roomID}', [roomController::class, 'roomdetails']);
Route::get('/reservethisroom/{roomID}', [roomController::class, 'reservethisroom']);


Route::get('/myreservation', function(){

       guestAuthCheck();

$reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
    ->where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)
    ->orderBy('core1_reservation.created_at', 'desc')
    ->select('core1_reservation.*', 'core1_room.*', 'core1_reservation.created_at as reservation_created_at')
    ->get();
  return view('guest.myreservation', ['reserverooms' => $reserverooms]);
});


Route::get('/aiguest', function(){
    guestAuthCheck();

    return view('guest.aibookingguest');
});

Route::get('/aisuggestion', function(){
    guestAuthCheck();
    return view('guest.components.dashboard.bas.withsuggestion');
});


Route::post('/aisubmit',[reservationController::class, 'aisubmit']);


Route::get('/guestroomfeedback', function(){
     guestAuthCheck();

     $reserverooms = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
    ->where('core1_reservation.reservation_bookingstatus', 'Checked out')
    ->where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)
    ->orderBy('core1_reservation.created_at', 'desc')
    ->select('core1_reservation.*', 'core1_room.*', 'core1_reservation.created_at as reservation_created_at')
    ->get();

    $myroomfeedbacks = roomfeedbacks::join('core1_guest', 'core1_guest.guestID', '=', 'core1_roomfeedback.guestID')
    ->join('core1_room', 'core1_room.roomID', '=', 'core1_roomfeedback.roomID')
    ->where('core1_roomfeedback.guestID', Auth::guard('guest')->user()->guestID)->latest('core1_roomfeedback.created_at')->get();
    
    return view('guest.roomfeedback', compact('reserverooms', 'myroomfeedbacks'));
});
Route::post('/submitroomfeedback', [roomfeedbackController::class, 'store']);