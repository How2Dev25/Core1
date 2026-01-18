<?php

use App\Http\Controllers\billingController;
use App\Http\Controllers\bookingAddonsController;
use App\Http\Controllers\channelController;
use App\Http\Controllers\doorlockController;
use App\Http\Controllers\ecmController;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\employeerequestController;
use App\Http\Controllers\eventtypeController;
use App\Http\Controllers\facilityController;
use App\Http\Controllers\hmpController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\larController;
use App\Http\Controllers\missingRFIDController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\posController;
use App\Http\Controllers\postCommentController;
use App\Http\Controllers\postController;
use App\Http\Controllers\ratingController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\restoController;
use App\Http\Controllers\roomController;
use App\Http\Controllers\roomfeedbackController;
use App\Http\Controllers\roommantenanceController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\userController;
use App\Models\additionalBooking;
use App\Models\additionalBookingCart;
use App\Models\aiPrompt;
use App\Models\AuditTrails;
use App\Models\Channel;
use App\Models\channelListings;
use App\Models\DeptAccount;
use App\Models\DeptLogs;
use App\Models\doorlock;
use App\Models\doorlockFrontdesk;
use App\Models\dynamicBilling;
use App\Models\Ecm;
use App\Models\ecmtype;
use App\Models\EmployeeReport;
use App\Models\eventPOS;
use App\Models\facility;
use App\Models\Guest;
use App\Models\guestloyaltypoints;
use App\Models\guestRatings;
use App\Models\Hmp;
use App\Models\hotelBilling;
use App\Models\Inventory;
use App\Models\loyaltyrules;
use App\Models\ordersfromresto;
use App\Models\Posts;
use App\Models\restointegration;
use App\Models\room;
use App\Models\Lar;
use App\Models\missingRFID;
use App\Models\requestEmployee;
use App\Models\room_maintenance;
use App\Models\roomfeedbacks;
use App\Models\roomtypes;
use App\Models\stockRequest;
use App\Models\Reservation;
use App\Models\ReservationPOS;
use App\Models\restoCart;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http; // ✅ Make sure this is the Http facade
use Illuminate\Support\Facades\Log;

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

// RBAC for admin
function verifydashboard(){
    if(Auth::user()->role !== 'Hotel Admin'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyusermanagement(){
    if(Auth::user()->role !== 'Hotel Admin'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyfrontdesk(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Receptionist'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifybilling(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Receptionist'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifycrm(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Guest Relationship Head'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyloyaltyandrewards(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Receptionist'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyroommanagement(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Room Attendant' && Auth::user()->role !== 'Room Manager'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifydoorlock(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Receptionist'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyroomtypes(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Room Attendant' && Auth::user()->role !== 'Room Manager'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyhousekeeping(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Maintenance Staff' && Auth::user()->role !== 'Room Manager' && Auth::user()->role !== 'Room Attendant'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyinventory(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Material Custodian' && Auth::user()->role !== 'Hotel Inventory Manager'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyevent(){
    if(Auth::user()->role !== 'Hotel Admin'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyhotelmarketing(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Hotel Marketing Officer'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifychannel(){
    if(Auth::user()->role !== 'Hotel Admin' && Auth::user()->role !== 'Receptionist'){
        return redirect('/restrictedemployee')->send();
    }
}

function verifyintegrationresto(){
    if(Auth::user()->role !== 'Hotel Admin'){
        return redirect('/restrictedemployee')->send();
    }
}
// 
Route::get('/', function () {
    $rooms = Room::all();
 



    // Fetch promos and events
    $promos = Hmp::where('hotelpromostatus', 'Active')->get();
    $events = ecmtype::all();
    $facility = facility::all();

    $promoCount = $promos->count();


     $feedbacks = roomfeedbacks::join(
        'core1_guest',
        'core1_guest.guestID',
        '=',
        'core1_roomfeedback.guestID'
    )
    ->join('core1_room', 'core1_room.roomID', '=', 'core1_roomfeedback.roomID')
    ->select(
        'core1_roomfeedback.*',
        'core1_roomfeedback.created_at as roomfeedbacktimestamp',
        'core1_guest.*',
        'core1_room.*'
    )
    ->inRandomOrder()
    ->limit(6)
    ->get();
    

    return view('index', compact(
        'rooms',
        'promos',
        'promoCount',
        'events',
        'facility',
        'feedbacks'
    ));
});

// terms and conditions

Route::get('/termsandconditions', function(){
    return view('landing.termsandcondition');
});



// AI Admin
Route::get('/geminiAnalytics', function() {
    employeeAuthCheck();
verifydashboard();
    // Fetch ALL AI prompts (not filtered by guest)
    $aiPrompts = aiPrompt::all();

    // Aggregate data for charts & preferences
    $roomTypeStats = $aiPrompts->groupBy('roomtype')->map->count();
    
    // If roomfeatures is JSON array
    $featureCounts = $aiPrompts->pluck('roomfeatures')
        ->map(fn($f) => is_string($f) ? json_decode($f, true) : $f)
        ->flatten()
        ->countBy();

    $avgDays = $aiPrompts->avg('reservation_days');

    // Guest preferences (grouped by guestID)
    $guestPreferences = $aiPrompts->groupBy('guestID');

    // Prepare data for AI admin insights
    $analyticsData = [
        'total_searches' => $aiPrompts->count(),
        'top_room_type' => $roomTypeStats->keys()->first() ?? 'Standard',
        'top_room_count' => $roomTypeStats->first() ?? 0,
        'all_room_types' => $roomTypeStats->keys()->toArray(),
        'top_feature' => $featureCounts->keys()->first() ?? 'wifi',
        'all_features' => $featureCounts->keys()->toArray(),
        'avg_days' => $avgDays ?? 2
    ];

    // Generate AI-powered admin insights using dedicated service
    $suggestionService = app(\App\Services\GeminiSuggestionService::class);
    $aiSuggestions = [];
    
    if ($aiPrompts->isNotEmpty()) {
        try {
            // GeminiSuggestionService automatically falls back on error
            $aiSuggestions = $suggestionService->generateAdminInsights($analyticsData);
        } catch (\Exception $e) {
            Log::error('Failed to generate admin insights:', ['error' => $e->getMessage()]);
            // Service handles fallback internally, but catch catastrophic errors
            $aiSuggestions = [];
        }
    }

    return view('admin.geminianalytics', compact(
        'aiPrompts',
        'roomTypeStats',
        'featureCounts',
        'avgDays',
        'guestPreferences',
        'aiSuggestions'
    ));
});
// resto integ

Route::get('/restoadmin', function () {

   employeeAuthCheck();

   verifyintegrationresto();

    $totalmenu = restointegration::count();
    $activemenu = restointegration::where('menu_status', 'Available')->count();
    $inactivemenu = restointegration::where('menu_status', 'Unavailable')->count();

    // Paginate 5 per page
    $menus = restointegration::latest()->paginate(5);

    return view('admin.resto', compact('menus', 'totalmenu', 'activemenu', 'inactivemenu'));
});
Route::post('/addmenu', [restoController::class, 'store']);
Route::put('/updatemenu/{menuID}',[restoController::class, 'modify'] );
Route::delete('/deletemenu/{menuID}', [restoController::class, 'delete'] );

// rating

Route::post('/landingrating', [ratingController::class, 'store']);

// booking via landing

Route::get('/bookinglanding', function(){
    return view('booking.booking');
});
Route::get('/roomselectionlanding', function(){

    return view('booking.roomselection');
});
Route::get('/selectedroom/{roomID}', [landingController::class, 'selectedroom']);
Route::get('/bookconfirmlanding/{roomID}', [landingController::class, 'bookconfirmlanding']);
Route::post('/guestcreatereservationlanding', [landingController::class, 'storereservation']);

Route::get('/booking/success/{id}', function($id) {
    $reservation = Reservation::findOrFail($id);
    $roomprice = Room::where('roomID', $reservation->roomID)->value('roomprice');
    $roomtype  = Room::where('roomID', $reservation->roomID)->value('roomtype');

             $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
            $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';
 return view('booking.bookingsuccess', compact(
        'reservation', 
        'roomprice', 
        'roomtype', 
        'serviceFeedynamic', 
        'taxRatedynamic'
    ));
})->name('booking.success');


Route::get('/eventselectionlanding', function(){
    

     $eventtypes = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
     ->latest('core1_eventtype.created_at')->get();

    return view('events.eventspage', compact('eventtypes'));
});

Route::get('/eventbookinglanding/{eventtype_ID}', [ecmController::class, 'eventbookinglanding']);



Route::get('/eventbooking/success/{eventbookingID}', function ($eventbookingID) {
    $reservationevent = Ecm::join('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
        ->where('core1_ecm.eventbookingID', $eventbookingID)
        ->select('core1_ecm.*', 'core1_eventtype.eventtype_name') // optional: pick columns
        ->firstOrFail();

         

    return view('events.success', compact('reservationevent'));
})->name('eventbooking.success');
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
Route::get('/pointofsale', function(){
      employeeAuthCheck();
      verifyfrontdesk();

      $reservationroom = ReservationPOS::join('core1_room', 'core1_room.roomID', '=', 'reservationpos.roomID')
    ->leftJoin('inventorypos', 'inventorypos.reservationposID', '=', 'reservationpos.reservationposID')
    ->leftJoin('core1_inventory', 'core1_inventory.core1_inventoryID', '=', 'inventorypos.core1_inventoryID')
    ->where('reservationpos.employeeID', Auth::user()->Dept_no)
    ->orderBy('reservationpos.created_at', 'desc')
    ->get([
        'reservationpos.*',
        'core1_room.roomtype',
        'core1_room.roomphoto',
        'core1_inventory.core1_inventory_name',
        'inventorypos.inventorypos_quantity',
        'inventorypos.inventorypos_total',
        'core1_inventory_image',
        'inventorypos.inventoryposID',
    ]);

    
      $reservationevent = eventPOS::join('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 
      'eventpos.eventtype_ID')->where('employeeID', Auth::user()->Dept_no)
      ->latest('eventpos.created_at')
      ->get();

      $servicefee = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
      $taxrate = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');
      $additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');
      $products = room::where('roomstatus', 'Available')->latest()->get();

      $ecmtype = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')->get();
      $rooms = room::where('roomstatus', 'Available')->latest()->get();
      $inventories = Inventory::all();

      $bookedreservations = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
      ->where('core1_reservation.reservation_bookingstatus', 'Checked In')
        ->get();
      $bookedreservationCart = additionalBookingCart::join('core1_inventory', 'core1_inventory.core1_inventoryID', '=', 'additionalsbookingcart.core1_inventoryID')
      ->join('core1_reservation', 'core1_reservation.reservationID', '=', 'additionalsbookingcart.reservationID')
      ->where('additionalsbookingcart.employeeID', Auth::user()->Dept_no)
      ->get();
      
    return view('admin.pos', compact(
    'servicefee',
    'taxrate',
    'additionalpersonfee',
    'products',
    'ecmtype',
    'rooms',
    'reservationroom',
    'reservationevent',
    'inventories',
    'bookedreservations',
    'bookedreservationCart',
));
});


Route::delete('/removeroompos/{reservationposID}', [posController::class, 'removeroom']);
Route::delete('/removeeventpos/{eventposID}', [posController::class, 'removeEvent' ]);
Route::post('/submitroompos', [posController::class, 'submitRoom']);
Route::post('/submitEvent', [posController::class, 'submitEvent']);
Route::post('/submitInventory', [posController::class, 'submitInventory']);
Route::delete('/removeadditional/{inventoryposID}', [posController::class, 'removeInventory']);
Route::post('/submitadditionalbooked', [posController::class, 'additionalBooking']);
Route::delete('/deleteadditionalbooked/{additionalsID}', [posController::class, 'deleteAdditionalBooking']);
Route::post('/posDone', [posController::class, 'POSButton']);



Route::get('/adminprofile', function(){
     employeeAuthCheck();
    return view('admin.profile');
});
Route::middleware(['auth'])->group(function () {
    Route::put('/department/profile/update', [userController::class, 'updateadmin'])->name('department.profile.update');
});

Route::get('employeeprofile/{Dept_no}', [userController::class, 'employeeProfile']);

Route::get('/employeedashboard', function() {
    employeeAuthCheck();
    verifydashboard();

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
    $channellisting = channelListings::where('channelStatus', 'Connected')->count();

    // === Marketing / Loyalty / Events ===
    $activecampaigns = Hmp::count();
    $loyaltyandrewards = Lar::count();
    $totalevents = Ecm::count();

    // === Revenue using hotelBilling ===
    $today = now();
    $currentMonth = $today->month;
    $currentYear  = $today->year;

    $lastMonthDate = $today->copy()->subMonth();
    $lastMonth = $lastMonthDate->month;
    $lastMonthYear = $lastMonthDate->year;

    $calculateRevenue = function($month, $year) {
        return hotelBilling::whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->sum('amount_paid');
    };

    $revenueCurrent = $calculateRevenue($currentMonth, $currentYear);
    $revenueLast    = $calculateRevenue($lastMonth, $lastMonthYear);
    $revenueChange  = $revenueLast > 0 ? (($revenueCurrent - $revenueLast) / $revenueLast) * 100 : 0;

    $nightsCurrent = hotelBilling::whereMonth('payment_date', $currentMonth)
        ->whereYear('payment_date', $currentYear)
        ->count();

    $nightsLast = hotelBilling::whereMonth('payment_date', $lastMonth)
        ->whereYear('payment_date', $lastMonthYear)
        ->count();

    // Avg Daily Rate
    $avgDailyRateCurrent = $nightsCurrent > 0 ? $revenueCurrent / $nightsCurrent : 0;
    $avgDailyRateLast    = $nightsLast > 0 ? $revenueLast / $nightsLast : 0;
    $avgDailyRateChange  = $avgDailyRateLast > 0 ? (($avgDailyRateCurrent - $avgDailyRateLast) / $avgDailyRateLast) * 100 : 0;

    // RevPAR
    $totalRooms = Room::count();
    $revPARCurrent = $totalRooms > 0 ? $revenueCurrent / $totalRooms : 0;
    $revPARLast    = $totalRooms > 0 ? $revenueLast / $totalRooms : 0;
    $revPARChange  = $revPARLast > 0 ? (($revPARCurrent - $revPARLast) / $revPARLast) * 100 : 0;

    // Occupancy Rate
    $occupancyCurrent = $totalRooms > 0 ? ($nightsCurrent / $totalRooms) * 100 : 0;
    $occupancyLast    = $totalRooms > 0 ? ($nightsLast / $totalRooms) * 100 : 0;
    $occupancyChange  = $occupancyLast > 0 ? ($occupancyCurrent - $occupancyLast) / $occupancyLast * 100 : 0;

    // === Last 30 Days Graph using hotelBilling ===
    $last30DaysLabels = [];
    $revenueLast30Days = [];
    $avgDailyRateLast30Days = [];
    $revPARLast30Days = [];
    $occupancyLast30Days = [];

    for ($i = 29; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i);
        $last30DaysLabels[] = $date->format('M d'); // e.g. "Nov 05"

        // Revenue for this day
        $dailyRevenue = hotelBilling::whereDate('payment_date', $date)->sum('amount_paid');
        $revenueLast30Days[] = $dailyRevenue;

        // Count of payments for ADR
        $dailyPayments = hotelBilling::whereDate('payment_date', $date)->count();
        $avgDailyRateLast30Days[] = $dailyPayments > 0 ? $dailyRevenue / $dailyPayments : 0;

        // RevPAR
        $revPARLast30Days[] = $totalRooms > 0 ? $dailyRevenue / $totalRooms : 0;

        // Occupancy
        $occupancyLast30Days[] = $totalRooms > 0 ? ($dailyPayments / $totalRooms) * 100 : 0;
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

    $rooms = Room::inRandomOrder()->get(); // Get 6 rooms
        
    $sessions = DB::table('sessions')
        ->join('department_accounts', 'sessions.user_id', '=', 'department_accounts.Dept_no')
        ->leftJoin('additionalinfoadmin', 'department_accounts.Dept_no', '=', 'additionalinfoadmin.Dept_no')
        ->whereBetween('sessions.last_activity', [
            Carbon::today()->timestamp,
            Carbon::tomorrow()->timestamp - 1
        ])
        ->orderBy('sessions.last_activity', 'desc')
        ->select(
            'sessions.*',
            'department_accounts.employee_name',
            'department_accounts.role',
            'department_accounts.dept_name',
            'department_accounts.employee_id',
            'department_accounts.status',
            'department_accounts.email',
            'adminphoto',
            'department_accounts.Dept_no',
        )
        ->take(5)
        ->get();

    $events = ecmtype::all();
    $promos = Hmp::all();
    $facility = facility::all();

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
        'occupancyLast30Days',
        'rooms',
        'sessions',
        'events',
        'facility',
        'promos',
    ));
});


Route::get('/departmentaccount', function(){
     employeeAuthCheck();
     verifyusermanagement();
    $employee = DeptAccount::all();
    $totalemployee = DeptAccount::count();
    $activeemployee = DeptAccount::where('status', 'Active')->count();
   $inactiveemployee = DeptAccount::where('status', '!=', 'Active')->count();
    return view('admin.departmentaccount', compact(
        'employee', 'totalemployee', 'activeemployee', 'inactiveemployee'));
});

Route::get('/guestaccount', function(){
     employeeAuthCheck();
     verifyusermanagement();
    $guest = Guest::latest('created_at')->paginate(5); // 10 guests per page
    $totalguest = Guest::count();
    $checkinguest = Reservation::where('reservation_bookingstatus', 'Checked in')->count();
    $pendingguest = Reservation::where('reservation_bookingstatus', 'Pending')->count();

    return view('admin.guestaccount', compact('guest', 'checkinguest', 'pendingguest', 'totalguest'));
});

Route::put('/suspendGuest/{guestID}', [userController::class, 'suspendGuest']);
Route::put('/unsuspendGuest/{guestID}', [userController::class, 'unsuspendGuest']);
Route::delete('/removeGuest/{guestID}', [userController::class, 'removeGuest']);

Route::get('/departmentlogs', function (Request $request) {
    employeeAuthCheck();
    verifyusermanagement();

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
     employeeAuthCheck();
    verifyusermanagement();
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
    verifyhotelmarketing();
    $hmpdata = Hmp::latest()->get();

     $promos = Hmp::all();
   
      $rooms = room::where('roomstatus', 'Available')->latest()->get();

       $totalRevenue = hotelBilling::sum('amount_paid');

       $roomreservations = Reservation::count();
       $eventreservations = Ecm::count();

       $totalreservations = $roomreservations + $eventreservations;
        $totalpromotions = Hmp::count();

    return view('admin.hmp', compact('hmpdata', 
    'promos', 'rooms', 'totalRevenue', 'totalreservations', 'totalpromotions'));
});
Route::post('/createhmp', [hmpController::class, 'createhmp']);
Route::get('/searchhmp', [hmpController::class, 'index']);
Route::put('/edithmp/{promoID}', [hmpController::class, 'edithmp']);
Route::delete('/deletehmp/{promoID}', [hmpController::class, 'deletehmp']);

// events and conference module
Route::get('/ecm', function(){
     employeeAuthCheck();
     verifyevent();

     $eventtypes = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
     ->latest('core1_eventtype.created_at')->get();
    $facilities = facility::latest()->get();
   
    return view('admin.ecm',  compact('eventtypes', 'facilities'));
});
Route::post('/createecm', [ecmController::class, 'store']);
Route::put('/editecm/{eventID}', [ecmController::class, 'update']);
Route::delete('/deleteecm/{eventID}', [ecmController::class, 'delete']);
Route::put('/approveecm/{eventID}', [ecmController::class, 'approved']);
Route::put('/cancelecm/{eventID}', [ecmController::class, 'cancel']);

// booking event and conference
Route::get('/eventbooking/{eventtype_ID}', [ecmController::class, 'bookevent']);
Route::post('/bookthisevent', [ecmController::class, 'store']);

// Event Booking Management
Route::get('/eventbookings', function(){
    employeeAuthCheck();
     verifyevent();

     $totaleventreservation = Ecm::count();
      $pendingeventreservation = Ecm::
        where('eventstatus', 'Pending')
      ->count();
       $confirmedeventreservation = Ecm::where('eventstatus', 'Confirmed')
      ->count();

        $cancelledeventreservation = Ecm::where('eventstatus', 'Cancelled')
      ->count();

    return view('admin.eventbookings', compact('totaleventreservation', 'pendingeventreservation', 'cancelledeventreservation',
        'confirmedeventreservation'));
    });

Route::put('/confirmeventbooking/{eventbookingID}', [ecmController::class, 'confirmReservation']);
Route::put('/doneeventbooking/{eventbookingID}', [ecmController::class, 'doneReservation']);
Route::put('/cancelbookingevent/{eventbookingID}',[ecmController::class, 'cancelReservation']);
Route::delete('/deletebookingevent/{eventbookingID}',[ecmController::class, 'deleteReservation']);
Route::get('/printeventreceipt/{eventbookingID}', [ecmController::class, 'printReceipt']);


Route::get('/payment/success/event', [ecmController::class, 'onlinepaymentsuccess'])->name('onlinepayment.success');
Route::get('/payment/cancel/event', [ecmController::class, 'onlinepaymentcancel'])->name('onlinepayment.cancel');

// facilities ecm

Route::get('/facilities', function(){
    employeeAuthCheck();
    verifyevent();
    $facilities = facility::latest()->get();

    $totalfacility = facility::count();

    $availablefacility = facility::where('facility_status', 'Available')->count();

     $occupiedfacility = facility::where('facility_status', 'Occupied')->count();
    return view('admin.facilities', compact('facilities', 'totalfacility', 'availablefacility'));
});

Route::post('/facilitycreate', [facilityController::class, 'store']);
Route::put('/facilitymodify/{facilityID}', [facilityController::class, 'modify']);
Route::delete('/facilitydelete/{facilityID}', [facilityController::class, 'delete']);

// event type
Route::post('/createecmtype', [eventtypeController::class, 'store']);
Route::put('/updateecmtype/{eventtype_ID}', [eventtypeController::class, 'modify']);
Route::delete('/deleteecmtype/{eventtype_ID}', [eventtypeController::class, 'delete']);

Route::get('/roommanagement', function(Request $request) {
     employeeAuthCheck();
    verifyroommanagement();
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

            $roomtypes = roomtypes::latest()->get();

    return view('admin.roomanagement', [
        'rooms' => $rooms, 
        'occupiedrooms' => $occupiedrooms,
        'availablerooms' => $availablerooms,
        'maintenancerooms' => $maintenancerooms,
        'reservedrooms' => $reservedrooms,
        'totalrooms' => $totalrooms,
        'roomtypes' => $roomtypes,
    ]);
});

Route::get('/roomtypesadmin', function(){
     employeeAuthCheck();
     verifyroomtypes();
    $totalroomtypes = roomtypes::count();
    $roomtypes = roomtypes::latest()->get();
    return view('admin.roomtypes', compact('roomtypes', 'totalroomtypes'));
});

Route::post('/createroomtype', [roomController::class, 'storeroomtype']);
Route::put('/modifyroomtype/{roomtypesID}', [roomController::class, 'modifyroomtype']);
Route::delete('/deleteroomtype/{roomtypesID}', [roomController::class, 'deleteroomtype']);
// FOR AI
Route::post('/processRoomPrompt', [RoomController::class, 'processRoomPrompt']);
// 
Route::post('/createroom', [roomController::class, 'store']);
Route::put('/modifyroom/{roomID}', [roomController::class, 'modify']);
Route::delete('/deleteroom/{roomID}', [roomController::class, 'delete']);

Route::get('/gotoroom/{roomID}', [roomController::class, 'redirect']);
Route::post('/additonalroom', [roomController::class, 'addphoto']);
Route::delete('/deleteroomphoto/{roomphotoID}', [roomController::class, 'deleteroomphoto']);

// Integration with door lock
Route::get('/doorlockadmin', function(){
    employeeAuthCheck();
    verifydashboard();

   $rooms = Room::all();

    $doorlocks = doorlock::join('core1_room', 'core1_room.roomID', '=', 'doorlock.roomID')
    ->leftJoin('doorlockfrontdesk', 'doorlockfrontdesk.doorlockID', '=', 'doorlock.doorlockID')
    ->select(
        'doorlock.*',
        'core1_room.roomID',
        'doorlockfrontdesk.doorlockID as frontdesk_doorlockID',
        'doorlockfrontdesk.doorlockfrontdesk_status',
        'doorlockfrontdesk.guestname',
        'doorlockfrontdesk.bookingID'
    )
    ->latest('doorlock.created_at')
    ->get();
    
    $totaldoorlock = doorlock::count();
    $totalassigned = doorlockFrontdesk::count();
    $totalActive = doorlock::where('doorlock_status', 'Active')->count();
    $totalinnactive = doorlock::where('doorlock_status', 'Innactive')->count();
    return view('admin.doorlock', compact('rooms', 'doorlocks', 
    'totalActive', 'totalinnactive', 'totalassigned', 'totaldoorlock'));
});

Route::get('/monitordoorlock/{doorlockID}', [doorlockController::class, 'monitor']);
// Route 1: Main page view
Route::get('/admin/doorlock/monitor/{doorlockID}', [doorlockController::class, 'monitor'])
    ->name('admin.doorlock.monitor');

// Route 2: AJAX data endpoint (for real-time updates)
Route::get('/admin/doorlock/monitor-data/{doorlockID}', [doorlockController::class, 'getMonitorData'])
    ->name('admin.doorlock.monitor.data');

Route::post('/storedoorLock', [doorlockController::class, 'storedoorLock']);
Route::put('/modifydoorLock/{doorlockID}', [doorlockController::class, 'modifydoorLock']);
Route::delete('/removedoorLock/{doorlockID}', [doorlockController::class, 'removedoorLock']);

Route::get('/assignkeycard/{reservationID}', [doorlockController::class, 'assignkeycard']);

Route::delete('/doorlock-assignments/{doorlockfrontdeskID}', [doorlockController::class, 'removeAssignment'])
    ->name('assignments.remove');
// Inventory And Stocks
Route::get('/ias', function(){
     employeeAuthCheck();
     verifyinventory();
    $totalItems = Inventory::count();
    $instock = Inventory::sum('core1_inventory_stocks');
    $lowstock = Inventory::whereColumn('core1_inventory_stocks', '<', 'core1_inventory_threshold')->count();
    $nostock = Inventory::where('core1_inventory_stocks', 0)->count();

    $inventory = Inventory::latest()->get();
    $stock = stockRequest::latest()->get();

    $deliveredStocks = stockRequest::where('core1_request_status', 'Delivered')->get();
    return view ('admin.ias', ['inventory' => $inventory, 'stock' => $stock, 
    'totalItems'=> $totalItems, 'instock' => $instock, 'lowstock' => $lowstock, 'nostock' => $nostock, 'deliveredStocks' => $deliveredStocks ]);
    });
Route::post('/createinventory', [inventoryController::class, 'store']);
Route::put('/updateinventory/{core1_inventoryID}', [inventoryController::class, 'modify']);
Route::delete('/deleteinventory/{core1_inventoryID}', [inventoryController::class, 'delete']);

// stocks
Route::post('/createstockrequest', [stockController::class, 'store']);
Route::put('/editstockrequest/{core1_stockID}', [stockController::class, 'modify']);
Route::delete('/deletestockrequest/{core1_stockID}', [stockController::class, 'delete']);

Route::put('/approvestockrequest/{core1_stockID}', [stockController::class, 'approve']);
Route::put('/rejectstockrequest/{core1_stockID}', [stockController::class, 'reject']);
Route::put('/deliveredstockrequest/{core1_stockID}', [stockController::class, 'deliver']);

// Housekeeping And Maintenance 
Route::get('/hmm', function(){
     employeeAuthCheck();
     verifyhousekeeping();
      $roomID = room::where('roomstatus', '!=', 'Occupied')->where('roomstatus', '!=', 'Maintenance')->latest()->get();
      $inventory = Inventory::latest()->get();


     $user = Auth::user();

if ($user->role == 'Hotel Admin') {

    $rooms = room_maintenance::join('core1_room', 'core1_room.roomID', '=', 'core1_roommaintenance.roomID')
        ->join('department_accounts', 'department_accounts.Dept_no', '=', 'core1_roommaintenance.maintenanceassigned_To')
        ->latest('core1_roommaintenance.created_at')
        ->get();

} elseif ($user->role == 'Maintenance Staff' || $user->role == 'Room Attendant') {

    $rooms = room_maintenance::join('core1_room', 'core1_room.roomID', '=', 'core1_roommaintenance.roomID')
        ->join('department_accounts', 'department_accounts.Dept_no', '=', 'core1_roommaintenance.maintenanceassigned_To')
        ->where('core1_roommaintenance.maintenanceassigned_To', $user->Dept_no)
        ->latest('core1_roommaintenance.created_at')
        ->get();
}
    
       $totalrooms = room::count();
         $maintenancerooms = room::where('roomstatus', 'Maintenance')->count();
         $urgentmaintenance = room_maintenance::where('maintenance_priority', 'Urgent')->count();
         $inventorystocks = Inventory::sum('core1_inventory_stocks'); 
          $lowstock = Inventory::whereColumn('core1_inventory_stocks', '<', 'core1_inventory_threshold')->count();
        $maintenancestaffs = DeptAccount::where('role', 'Maintenance Staff')->get();
        return view('admin.hmm', [
            'inventory' => $inventory, 'rooms' => $rooms, 'roomID' => $roomID,
        'totalrooms' => $totalrooms, 'maintenancerooms' => $maintenancerooms, 'urgentmaintenance' => $urgentmaintenance, 'inventorystocks' => $inventorystocks, 
        'lowstock' => $lowstock,
    'maintenancestaffs' => $maintenancestaffs ]);

});
Route::post('/createmaintenance', [roommantenanceController::class, 'store']);
Route::put('/updatemaintenance/{roommaintenanceID}', [roommantenanceController::class, 'modify']);
Route::put('/completemaintenance/{roommaintenanceID}', [roommantenanceController::class, 'complete']);
Route::delete('/deletemaintenance/{roommaintenanceID}', [roommantenanceController::class, 'delete']);
Route::put('usestocks/{core1_inventoryID}', [roommantenanceController::class, 'use']);

// room feedbacks
Route::get('/roomfeedback', function(Request $request) {
    employeeAuthCheck();
    verifycrm();
    // Get filter (Open/Closed/All)
    $statusFilter = $request->get('status', 'all');

    // Build base query
   $query = roomfeedbacks::join('core1_guest', 'core1_guest.guestID', '=', 'core1_roomfeedback.guestID')
    ->join('core1_room', 'core1_room.roomID', '=', 'core1_roomfeedback.roomID')
    ->latest('core1_roomfeedback.created_at');

// Apply filter if not "all"
if ($statusFilter === 'Open') {
    $query->where('roomfeedbackstatus', 'Open');
} elseif ($statusFilter === 'Closed') {
    $query->where('roomfeedbackstatus', 'Closed');
}

// Paginate results (10 per page)
$myroomfeedbacks = $query->paginate(10)->withQueryString();


    // Stats
    $stats = [
        'total'    => roomfeedbacks::count(),
        'positive' => roomfeedbacks::where('roomrating', '>=', 4)->count(),
        'negative' => roomfeedbacks::where('roomrating', '<=', 2)->count(),
        'pending'  => roomfeedbacks::where('roomfeedbackstatus', 'Open')->count(),
    ];

    // Trend stats
    $currentMonthCount = roomfeedbacks::whereMonth('roomfeedbackdate', Carbon::now()->month)
        ->whereYear('roomfeedbackdate', Carbon::now()->year)
        ->count();
    $lastMonthCount = roomfeedbacks::whereMonth('roomfeedbackdate', Carbon::now()->subMonth()->month)
        ->whereYear('roomfeedbackdate', Carbon::now()->subMonth()->year)
        ->count();

    $stats['trend'] = [
        'current' => $currentMonthCount,
        'last'    => $lastMonthCount,
        'percent' => $lastMonthCount > 0
                        ? round((($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 1)
                        : 100,
    ];

    return view('admin.roomfeedback', compact('myroomfeedbacks', 'stats', 'statusFilter'));
});

Route::put('/feedbackrespond/{roomfeedbackID}', [roomfeedbackController::class, 'respond']);
Route::get('/servicefeedback', function(){
     employeeAuthCheck();
     verifycrm();

     $ratings = guestRatings::latest()->get();

    return view('admin.servicefeedback', compact('ratings'));
});

Route::delete('/servicefeedback/delete/{ratingID}', [ratingController::class, 'delete']);


// Channel Management
Route::get('/channel', function(){
     employeeAuthCheck();
     verifychannel();
    $rooms = room::where('roomstatus', 'Available')->latest()->get();
   $channels = Channel::join('core1_room', 'core1_room.roomID', '=', 'channel_table.roomID')
    ->join('channel_listing', 'channel_listing.channelListingID', 'channel_table.channelListingID')
    ->select('channel_table.*', 'core1_room.*', 'channel_listing.*', 'channel_table.created_at as createdchannel')
    ->orderBy('channel_table.created_at', 'desc')
    ->get();

    $channelListing = channelListings::withCount('listings')->get();

   
    return view('admin.channel', compact('rooms','channelListing', 'channels'));
}); 

Route::post('/createlisting', [channelController::class, 'store']);
Route::put('/updatelisting/{channelID}', [channelController::class, 'modify']);
Route::delete('/deletelisting/{channelID}', [channelController::class, 'delete']);

// creates channel

Route::post('/createChannel', [channelController::class, 'createChannel']);
Route::put('/modifyChannel/{channelListingID}', [channelController::class, 'modifyChannel']);
Route::delete('/deleteChannel/{channelListingID}', [channelController::class, 'deleteChannel']);

// booking and reservation
Route::get('/bas', function(){
     employeeAuthCheck();
     verifyfrontdesk();
    $rooms = room::where('roomstatus', 'Available')->latest()->get();
    $reserverooms =  Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('core1_reservation.created_at')
        ->get();

         $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
        $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

            $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
            $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';
    return  view('admin.bas', ['rooms' => $rooms, 'reserverooms' => $reserverooms, 
    'serviceFeedynamic' => $serviceFeedynamic,
    'taxRatedynamic' => $taxRatedynamic,
]);
});
Route::get('/aibas', function(){
     employeeAuthCheck();
    return view('admin.aibas');
});

Route::post('/aireserve', [reservationController::class, 'searchRooms']);

Route::post('/createreservation', [reservationController::class, 'store']);
Route::put('/modifyreservation/{reservationID}', [reservationController::class, 'modify']);
Route::delete('/deletereservation/{reservationID}', [reservationController::class, 'delete']);


// HR integration
Route::get('/requestemployee', function(){
     employeeAuthCheck();
     verifydashboard();

     
    $requestemp = requestEmployee::latest()->get();

    $totalreq = requestEmployee::count();

    $pendingreq = requestEmployee::where('status', 'Pending')->count();
    $approvereq = requestEmployee::where('status', 'Approved')->count();
    $rejectreq = requestEmployee::where('status', 'Rejected')->count();
    return view('admin.requesitionemp', compact('requestemp', 
    'pendingreq', 'approvereq', 'rejectreq', 'totalreq'));
});

Route::post('/requestEmployee', [employeerequestController::class, 'requestEmployee']);
Route::delete('/removerequestEmployee/{requestempID}', [employeerequestController::class, 'removerequestEmployee']);

// report employee
Route::get('/reportemployee', function(){
     employeeAuthCheck();
     verifydashboard();

     $employees = DeptAccount::all();
     $reports = EmployeeReport::latest()->get();

     $totalemp = DeptAccount::count();
     $active = DeptAccount::where('status', 'Active')->count();
     $reportscount = EmployeeReport::count();
     $awaiting = EmployeeReport::where('status', 'Pending')->count();
     
    return view('admin.reportemployee', compact('employees', 
    'reports', 'totalemp', 'active', 'reportscount', 'awaiting'));
});

Route::post('/reportemp', [EmployeeReportController::class, 'store']);
Route::delete('/removereport/{reportID}', [EmployeeReportController::class, 'remove']);
// guest
Route::post('/guestcreatereservation', [reservationController::class, 'gueststore']);

 

Route::get('/reservationpage', function(){
     employeeAuthCheck();
     verifyfrontdesk();
$servicefee = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
$taxrate = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');
$additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');
    $rooms = room::where('roomstatus', 'Available')->latest()->get();

    return view('admin.components.bas.reservationpage', ['rooms' => $rooms, 
    'servicefee' => $servicefee,
    'taxrate' => $taxrate,
    'additionalpersonfee' => $additionalpersonfee,]);
});

Route::get('/aiform', function(){
     employeeAuthCheck();
    return view('admin.components.bas.aiform');
});


// front desk
Route::get('/frontdesk', function(){
     employeeAuthCheck();
     verifyfrontdesk();
       $reserverooms =  Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('core1_reservation.created_at')
        ->get();

        $reservations = Ecm::join('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
    ->select(
        'core1_ecm.*',
        'core1_eventtype.eventtype_name',
        'core1_eventtype.eventtype_photo',
        'core1_eventtype.eventtype_price'
    )
    ->latest('core1_ecm.created_at')
    ->get();

          $totaleventreservation = Ecm::count();
      $pendingeventreservation = Ecm::
        where('eventstatus', 'Pending')
      ->count();
       $confirmedeventreservation = Ecm::where('eventstatus', 'Confirmed')
      ->count();

        $cancelledeventreservation = Ecm::where('eventstatus', 'Cancelled')
      ->count();

    //   stocks

     $totalItems = Inventory::count();
     $stock = stockRequest::latest()->get();
    $instock = Inventory::sum('core1_inventory_stocks');
    $lowstock = Inventory::whereColumn('core1_inventory_stocks', '<', 'core1_inventory_threshold')->count();
    $nostock = Inventory::where('core1_inventory_stocks', 0)->count();

    $inventory = Inventory::latest()->get();

    $additionalBooking = additionalBooking::join('core1_reservation', 'core1_reservation.reservationID', '=', 'additional_booking.reservationID')
    ->join('core1_inventory', 'core1_inventory.core1_inventoryID', '=', 'additional_booking.core1_inventoryID')
    ->latest('additional_booking.created_at')
    ->get();

      $doorfrontdesk = doorlockFrontdesk::join('doorlock', 'doorlock.doorlockID', '=', 'doorlockfrontdesk.doorlockID')
      ->latest('doorlockfrontdesk.created_at')
      ->get();
    
    return view('admin.frontdesk', compact('reserverooms', 'totaleventreservation', 'pendingeventreservation', 
    'confirmedeventreservation', 'cancelledeventreservation', 'totalItems', 'instock', 'lowstock', 'nostock', 'inventory', 'additionalBooking', 'doorfrontdesk', 'reservations' ));
});

Route::put('/reservationcheckin/{reservationID}', [reservationController::class, 'checkin']);
Route::put('/reservationcheckout/{reservationID}', [reservationController::class, 'checkout']);
Route::put('/reservationcancelled/{reservationID}', [reservationController::class, 'cancel']);
Route::put('/reservationconfirm/{reservationID}', [reservationController::class, 'confirm']);

Route::put('/addonPaid/{additionalbookingID}', [bookingAddonsController::class, 'markAsPaid']);
Route::delete('/addonRemove/{additionalbookingID}', [bookingAddonsController::class, 'removeAddon']);

Route::get('/printinventoryreceipt/{additionalbookingID}', [bookingAddonsController::class, 'printReceipt']);

// loyalty and rewards

Route::get('/lar', function(){
     employeeAuthCheck();
     verifyloyaltyandrewards();
    $rooms = room::whereNotIn('roomID', function ($query) {
    $query->select('roomID')->from('core1_loyaltyandrewards');
})->get();
    $roompoints = Lar::join('core1_room', 'core1_room.roomID', '=', 'core1_loyaltyandrewards.roomID')
    ->latest('core1_loyaltyandrewards.created_at')
    ->get();


    $totalpoints = Lar::sum('loyalty_value');
    $totalreward = Lar::count();

    $rules = loyaltyrules::all();

    $activemembers = Guest::count();

    $totalrules = loyaltyrules::count();

    return view('admin.lar', 
    ['rooms' => $rooms, 'roompoints' => $roompoints, 'totalpoints' => $totalpoints, 
    'totalreward' => $totalreward,
    'rules'=> $rules,
    'activemembers' => $activemembers,
    'totalrules' => $totalrules]);
});
Route::post('/createlar', [larController::class, 'store']);
Route::put('/editlar/{loyaltyID}', [larController::class, 'modify']);
Route::put('/expirelar/{loyaltyID}', [larController::class, 'expired']);
Route::delete('/deletelar/{loyaltyID}', [larController::class, 'delete']);
Route::post('/guestadd/{loyaltyID}', [larController::class, 'addtoguest']);

// loyalty and rewards rule
Route::post('/createlarrules', [larController::class, 'rulesInsert']);
Route::put('/modifylarrules/{loyaltyrulesID}', [larController::class, 'rulesModify']);
Route::delete('/removelarrules/{loyaltyrulesID}', [larController::class, 'rulesRemoved']);






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
Route::delete('/cancelreg/{guestID}', [userController::class, 'cancelguestregistration']);

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

    $myloyaltypoints = guestloyaltypoints::where('guestID', Auth::guard('guest')->user()->guestID)
    ->value('points_balance');

    $events = ecmtype::all();

    $promos = Hmp::all();

    $facility = facility::all();

    $rooms = Room::leftjoin('core1_loyaltyandrewards', 'core1_loyaltyandrewards.roomID', '=', 'core1_room.roomID')->
    where('core1_room.roomstatus', 'Available')
    ->
     select(
        'core1_room.*',
        DB::raw('COALESCE(core1_loyaltyandrewards.loyalty_value, 0) as loyalty_value'),
        'core1_loyaltyandrewards.roomID as loyaltyroomID'
    )->inRandomOrder()->get(); 

 $reservations = Reservation::where('guestID', $guestID)->get();

    // ✅ Example: count reservations per month for the chart
   $rawData = Reservation::where('guestID', $guestID)
    ->selectRaw('MONTH(reservation_checkin) as month, COUNT(*) as total')
    ->groupBy('month')
    ->orderBy('month')
    ->pluck('total', 'month')
    ->toArray();

// Build an array of 12 months (index 0=Jan, 11=Dec)
$monthlyReservations = [];
for ($m = 1; $m <= 12; $m++) {
    $monthlyReservations[] = $rawData[$m] ?? 0;
}

    // ✅ Total reservations
    $guestTotalReservation = $reservations->count();

    $totaleventreservation = Ecm::where('guestID', Auth::guard('guest')->user()->guestID)->count();

    return view('guest.dashboard', compact(
        'guesttotalreservation',
        'previousReservations',
        'recentstay',
        'favoriteroom',
        'events',
        'rooms',
        'promos',
        'facility',
        'guestTotalReservation',
        'monthlyReservations',
        'myloyaltypoints',
        'totaleventreservation',
    ));
});

Route::get('/managefees', function(){
    employeeAuthCheck();
    verifyfrontdesk();

    $feedata = dynamicBilling::latest()->get();

   $servicefee = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
$taxrate = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');
$additionalpersonfee = dynamicBilling::where('dynamic_name', 'Additional Person Fee')->value('dynamic_price');

    return view('admin.billingfee', compact('feedata', 'servicefee', 'taxrate', 'additionalpersonfee'));
});
Route::post('/createfee', [billingController::class, 'store']);
Route::put('/updatefee/{dynamic_billingID}', [billingController::class, 'modify']);

// Transaction History
Route::get('/transactionhistoryadmin', function(Request $request){
    employeeAuthCheck();
    verifyfrontdesk();

    // Stats
    $totalRevenue = hotelBilling::sum('amount_paid');
    $totalTransaction = hotelBilling::count();
    $historyWithAccount = hotelBilling::whereNotNull('guestID')->count();
    $historyWithoutAccount = hotelBilling::whereNull('guestID')->count();

    // Transactions query
    $query = hotelBilling::query();

    // Filter by date
    if ($request->filter ?? false) {
        switch ($request->filter) {
            case 'week':
                $query->where('payment_date', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('payment_date', '>=', now()->subMonth());
                break;
        }
    }

    // Pagination
    $billingHistory = $query->orderBy('payment_date', 'desc')->paginate(10);

    // Pass all to view
    return view('admin.transactionhistory', compact(
        'totalRevenue',
        'totalTransaction',
        'historyWithAccount',
        'historyWithoutAccount',
        'billingHistory'
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
  $reserverooms = Reservation::from('core1_reservation as r')
    ->join('core1_room as room', 'room.roomID', '=', 'r.roomID')
    ->leftJoin('core1_loyaltyandrewards as lr', 'lr.roomID', '=', 'room.roomID')
    ->leftJoin('doorlock as dl', 'dl.roomID', '=', 'room.roomID')
    ->leftJoin('doorlockfrontdesk as fd', 'fd.doorlockID', '=', 'dl.doorlockID')
    ->where('r.guestID', Auth::guard('guest')->user()->guestID)
    ->orderBy('r.created_at', 'desc')
    ->select(
        'r.*',                 // reservation data
        'room.*',              // room data
        DB::raw('COALESCE(lr.loyalty_value, 0) as loyalty_value'),
        'lr.roomID as loyaltyroomID',
        'r.created_at as reservation_created_at',

        // ADDED (recommended)
        'dl.doorlockID',
        'dl.rfid',
        'fd.doorlockfrontdesk_status'
    )
    ->get();
    
    $totalreservation = Reservation::where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)->count();
    $approvereservation = Reservation::where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)
    ->where('reservation_bookingstatus', 'Confirmed')->count();
    $cancelledreservation = Reservation::where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)
    ->where('reservation_bookingstatus', 'Cancelled')->count();
    $pendingreservation = Reservation::where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)
    ->where('reservation_bookingstatus', 'Pending')->count();

       $servicefee2 = dynamicBilling::where('dynamic_name', 'Service Fee')->value('dynamic_price');
        $taxrate2 = dynamicBilling::where('dynamic_name', 'Tax Rate')->value('dynamic_price');

         $serviceFeedynamic = rtrim(rtrim(number_format($servicefee2, 2), '0'), '.') . '%';
        $taxRatedynamic = rtrim(rtrim(number_format($taxrate2, 2), '0'), '.') . '%';
  return view('guest.myreservation', compact('reserverooms', 'totalreservation', 
  'approvereservation','pendingreservation', 'cancelledreservation','serviceFeedynamic', 'taxRatedynamic'));
});

Route::get('/aiguest', function() {
    guestAuthCheck(); // your existing guest auth check

    // Get the current guest's ID (adjust based on your auth logic)
    $guestID = Auth::guard('guest')->user()->guestID;

    // Fetch AI prompts for this guest
    $aiPrompts = aiPrompt::where('guestID', $guestID)->get();

    // Aggregate data for charts & preferences
    $roomTypeStats = $aiPrompts->groupBy('roomtype')->map->count();
    
    // If roomfeatures is JSON array
    $featureCounts = $aiPrompts->pluck('roomfeatures')
        ->map(fn($f) => is_string($f) ? json_decode($f, true) : $f)
        ->flatten()
        ->countBy();

    $avgDays = $aiPrompts->avg('reservation_days');

    // Guest preferences (grouped by guestID – here only one guest)
    $guestPreferences = $aiPrompts->groupBy('guestID');

    return view('guest.aibookingguest', compact('aiPrompts','roomTypeStats','featureCounts','avgDays','guestPreferences'));
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
Route::delete('/deleteroomfeedback/{roomfeedbackID}', [roomfeedbackController::class, 'delete'] );
Route::put('/updateroomfeedback/{roomfeedbackID}', [roomfeedbackController::class, 'update']);


// guest foodmenu

Route::get('/menuorder', function () {
    guestAuthCheck();
    $checkinroom = Reservation::join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')->where('core1_reservation.guestID', Auth::guard('guest')->user()->guestID)
    ->where('core1_reservation.reservation_bookingstatus', 'Checked in')->latest('core1_reservation.created_at')->get();
    $menus = restointegration::latest()->paginate(6); // 6 menus per page

    $mycart = restoCart::join('resto_integration', 'resto_integration.menuID', '=', 'resto_cart.menuID')
    ->where('resto_cart.guestID', Auth::guard('guest')->user()->guestID)
    ->latest('resto_cart.created_at')
    ->get();
    return view('guest.ordermenu', compact('menus', 'checkinroom', 'mycart'));
});

Route::get('/myorder', function(){
     guestAuthCheck();
    $mycart = restoCart::join('resto_integration', 'resto_integration.menuID', '=', 'resto_cart.menuID')
    ->where('resto_cart.guestID', Auth::guard('guest')->user()->guestID)
    ->latest('resto_cart.created_at')
    ->get();
    return view('guest.myorders', compact('mycart'));
});

Route::post('/addtocart', [orderController::class, 'addtocart']);
Route::delete('/deletecart/{cartID}', [orderController::class, 'deletefromcart']);

Route::get('/ordercart', [orderController::class, 'confirmorder']);

Route::get('/recentorders', function(){
     guestAuthCheck();
      $mycart = ordersfromresto::join('resto_integration', 'resto_integration.menuID', '=', 'orderfromresto.menuID')
    ->where('orderfromresto.guestID', Auth::guard('guest')->user()->guestID)
    ->latest('orderfromresto.created_at')
    ->get();
    return view('guest.recentorders', compact('mycart'));
});



Route::delete('/cancelorder/{orderID}', [orderController::class, 'cancelorder']);
Route::put('/deliverorder/{orderID}', [orderController::class, 'delivered']);

Route::get('/profileguest', function(){
     guestAuthCheck();
    return view('guest.profile');
});

Route::put('/guestupdate/{guestID}', [userController::class, 'updateguest']);





Route::get('/guestcommunity', function (Request $request) {
    guestAuthCheck();

    $filter = $request->query('filter', 'recent');
    $guestID = Auth::guard('guest')->user()->guestID;

    $posts =  Posts::leftJoin('core1_guest', 'core1_guest.guestID', '=', 'posts.guestID')
        ->select(
            'posts.*',
            'core1_guest.guest_name',
            'core1_guest.guest_photo'
        )
       ->withCount('likes', 'comments');
       

    // 🔹 FILTER LOGIC
    if ($filter === 'popular') {
        $posts->orderBy('likes_count', 'desc');
    } elseif ($filter === 'my_posts') {
        $posts->where('posts.guestID', $guestID)
              ->orderBy('posts.created_at', 'desc');
    } else {
        // most recent (default)
        $posts->orderBy('posts.created_at', 'desc');
    }

    $posts = $posts->paginate(10)->withQueryString();

$myRecentPosts =Posts::leftJoin('core1_guest', 'core1_guest.guestID', '=', 'posts.guestID')
    ->where('posts.guestID', $guestID)
    ->select(
        'posts.*',
        'core1_guest.guest_name',
        'core1_guest.guest_photo'
    )
    ->withCount('likes', 'comments')
    ->latest('posts.created_at')
    ->take(5)
    ->get();

    $promos = Hmp::all();
    return view('guest.community', compact('posts', 'filter', 'myRecentPosts', 'promos'));
})->name('guest.community');;


// admin side
Route::get('/guestcommunityadmin', function (Request $request) {
   employeeAuthCheck();
    verifycrm();
    $filter = $request->query('filter', 'recent');


    $posts = Posts::leftJoin('core1_guest', 'core1_guest.guestID', '=', 'posts.guestID')
        ->select(
            'posts.*',
            'core1_guest.guest_name',
            'core1_guest.guest_photo'
        )
        ->withCount('likes', 'comments');
       

    // 🔹 FILTER LOGIC
    if ($filter === 'popular') {
        $posts->orderBy('likes_count', 'desc');
    } elseif ($filter === 'my_posts') {
        $posts->where('posts.post_role', 'Admin')
              ->orderBy('posts.created_at', 'desc');
    } else {
        // most recent (default)
        $posts->orderBy('posts.created_at', 'desc');
    }

    $posts = $posts->paginate(10)->withQueryString();

$myRecentPosts = Posts::leftJoin('core1_guest', 'core1_guest.guestID', '=', 'posts.guestID')
    ->where('posts.post_role', 'Admin')
    ->select(
        'posts.*',
        'core1_guest.guest_name',
        'core1_guest.guest_photo'
    )
    ->withCount('likes', 'comments')
    ->latest('posts.created_at')
    ->take(5)
    ->get();

    $promos = Hmp::all();
    return view('admin.community', compact('posts', 'filter', 'myRecentPosts', 'promos'));
})->name('community');;

// comment

Route::post('/postcomment/{postID}', [postCommentController::class, 'store']);
Route::delete('/deletecomment/{postID}/{commentID}', [PostCommentController::class, 'destroy'])
    ->name('deletecomment');
    
// admin side forum


Route::post('/communitypost', [postController::class, 'store']);
Route::put('/communityupdate/{postID}', [postController::class, 'update']);
Route::delete('/communityremove/{postID}', [postController::class, 'destroy']);
Route::post('/communityreport/{postID}', [postController::class, 'report']);


Route::post('/posts/{postID}/like', [postController::class, 'like'])->name('posts.like');
Route::post('/posts/{postID}/unlike', [postController::class, 'unlike'])->name('posts.unlike');

Route::get('/redirectcommentadmin/{postID}', [postController::class, 'redirectCommentAdmin'])->name('redirectcommentadmin');
Route::get('/redirectcommentguest/{postID}', [postController::class, 'redirectCommentGuest'])->name('redirectcommentguest');

// Online Payment 
Route::get('/payment/success', [ReservationController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/success/landing', [ReservationController::class, 'paymentSuccessLanding'])->name('payment.success.landing');
Route::get('/payment/success/ai', [ReservationController::class, 'paymentSuccessAI'])->name('payment.success.ai');
Route::get('/payment/cancel', [ReservationController::class, 'paymentCancel'])->name('payment.cancel');

// billing history guest
Route::get('/paymenthistoryguest', function(Request $request){
     guestAuthCheck();
    $guestID = Auth::guard('guest')->user()->guestID;

    // Stats
    $totalRevenue = hotelBilling::where('guestID', $guestID)->sum('amount_paid');
    $totalTransaction = hotelBilling::where('guestID', $guestID)->count();

    // Last Payment
    $lastPayment = hotelBilling::where('guestID', $guestID)
                               ->latest('payment_date')
                               ->first();
    $lastPaymentAmount = $lastPayment->amount_paid ?? 0;
    $lastPaymentDate = $lastPayment ? Carbon::parse($lastPayment->payment_date)->format('M d, Y h:i A') : null;

    // Transactions query
    $query = hotelBilling::where('guestID', $guestID);

    // Filter by date
    if ($request->filter ?? false) {
        switch ($request->filter) {
            case 'week':
                $query->where('payment_date', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('payment_date', '>=', now()->subMonth());
                break;
        }
    }

    // Pagination (10 per page)
    $billingHistory = $query->orderBy('payment_date', 'desc')->paginate(10);

    return view('guest.paymenthistory', compact(
        'totalRevenue',
        'totalTransaction',
        'lastPaymentAmount',
        'lastPaymentDate',
        'billingHistory'
    ));
});

Route::get('/bookeventguest', function(){
        guestAuthCheck();
     $eventtypes = ecmtype::join('core1_facility', 'core1_facility.facilityID', '=', 'core1_eventtype.facilityID')
     ->latest('core1_eventtype.created_at')->get();

    return view('guest.bookevent', compact('eventtypes'));
});

Route::get('/eventbookingguest/{eventtype_ID}', [ecmController::class, 'eventbookingguest']);

Route::get('/myeventbookings', function(){
      guestAuthCheck();

      $totaleventreservation = Ecm::where('guestID', Auth::guard('guest')->user()->guestID)->count();
      $pendingeventreservation = Ecm::where('guestID', Auth::guard('guest')->user()->guestID)
      ->where('eventstatus', 'Pending')
      ->count();
       $confirmedeventreservation = Ecm::where('guestID', Auth::guard('guest')->user()->guestID)
      ->where('eventstatus', 'Confirmed')
      ->count();

        $cancelledeventreservation = Ecm::where('guestID', Auth::guard('guest')->user()->guestID)
      ->where('eventstatus', 'Cancelled')
      ->count();


$reservations = Ecm::join('core1_eventtype', 'core1_eventtype.eventtype_ID', '=', 'core1_ecm.eventtype_ID')
        ->where('core1_ecm.guestID', Auth::guard('guest')->user()->guestID)
        ->latest('core1_ecm.created_at')
        ->get();

        return view('guest.myeventreservation', compact('reservations', 'totaleventreservation',
    'pendingeventreservation', 'confirmedeventreservation', 'cancelledeventreservation'));

});




// For AI debug
Route::get('/gemini/models', function () {
    $apiKey = config('services.gemini.key');
    $endpoint = 'https://generativelanguage.googleapis.com/v1/models';

    try {
        $response = Http::timeout(30)->get($endpoint . '?key=' . $apiKey);

        if ($response->failed()) {
            log::error('⚠️ Gemini API failed to list models', ['response' => $response->body()]);
            return response()->json(['error' => 'Failed to fetch models.'], 500);
        }

        $data = $response->json();
        // $data['models'] usually contains the list of available models
        return response()->json($data);

    } catch (\Exception $e) {
        Log::error('❌ Gemini API exception:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Exception: ' . $e->getMessage()], 500);
    }
});

// RFID missing

Route::get('/missingRFID', function () {

    $rfidbookings = doorlockFrontdesk::join('doorlock', 'doorlock.doorlockID', '=', 'doorlockfrontdesk.doorlockID')
        ->join('core1_reservation', 'core1_reservation.bookingID', '=', 'doorlockfrontdesk.bookingID')
        ->join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('doorlockfrontdesk.created_at')
        ->get();

    return view('missingrfid.missing', compact('rfidbookings'));
});

Route::post('/submitMissingRFID', [missingRFIDController::class, 'store']);

Route::get('/missingrfid_guest', function(){
       guestAuthCheck();
         $rfidbookings = doorlockFrontdesk::join('doorlock', 'doorlock.doorlockID', '=', 'doorlockfrontdesk.doorlockID')
        ->join('core1_reservation', 'core1_reservation.bookingID', '=', 'doorlockfrontdesk.bookingID')
        ->join('core1_room', 'core1_room.roomID', '=', 'core1_reservation.roomID')
        ->latest('doorlockfrontdesk.created_at')
        ->get();
    return view('guest.missingrfid', compact('rfidbookings'));
});

Route::get('/missingRFID_admin', function(){

      employeeAuthCheck();
    verifydashboard();

$missingRFIDs = missingRFID::join('doorlock', 'doorlock.doorlockID', '=', 'missing_rfid.doorlockID')
    ->join('doorlockfrontdesk', 'doorlockfrontdesk.doorlockID', '=', 'doorlock.doorlockID')
    ->join('core1_reservation', 'core1_reservation.bookingID', '=', 'doorlockfrontdesk.bookingID')
    ->join('core1_room', 'core1_room.roomID', '=', 'doorlock.roomID')
    ->select(
        'missing_rfid.*',
        'core1_reservation.bookingID',
        'core1_reservation.guestname as guest_name',
        'core1_reservation.roomID',
        'doorlockfrontdesk.doorlockfrontdeskID',
        
    )
    ->get();


    $countmissing = missingRFID::where('missing_rfid_status', '!=', 'Resolved')->count();
    $totaldoorlock = doorlock::count();
    $totalassigned = doorlockFrontdesk::count();
   

    return view('admin.missingrfid', compact('missingRFIDs', 'countmissing', 'totaldoorlock', 'totalassigned'));
});

Route::put('removemissingrfid/{doorlockfrontdeskID}', [missingRFIDController::class, 'removeAssignment']);