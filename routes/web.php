<?php

use App\Http\Controllers\channelController;
use App\Http\Controllers\ecmController;
use App\Http\Controllers\hmpController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\larController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\roomController;
use App\Http\Controllers\roommantenanceController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\userController;
use App\Models\Channel;
use App\Models\Ecm;
use App\Models\Hmp;
use App\Models\Inventory;
use App\Models\room;
use App\Models\Lar;
use App\Models\room_maintenance;
use App\Models\stockRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// security for guest
function guestAuthCheck() {
    if (!Auth::guard('guest')->check()) {
        return redirect('/restrictedguest')->send(); // stop execution and redirect
    }
}

// 



Route::get('/', function () {
    return view('index');
});


// Login 
Route::get('/employeelogin', function(){
    return view('employeelogin.login');
});
// guest
Route::post('/guestloginform', [userController::class, 'guestlogin']);
Route::get('/loginguest', function(){
    return view('guestlogin.login');
});

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

Route::get('/employeedashboard', function(){
    return view('admin.dashboard');
});

Route::get('/hmp', function(){
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
    return view('admin.roomfeedback');
});
Route::get('/servicefeedback', function(){
    return view('admin.servicefeedback');
});


// Channel Management
Route::get('/channel', function(){
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
    $rooms = room::where('roomstatus', 'Available')->latest()->get();
    return view('admin.components.bas.reservationpage', ['rooms' => $rooms]);
});

Route::get('/aiform', function(){
    return view('admin.components.bas.aiform');
});


// front desk
Route::get('/frontdesk', function(){
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
Route::get('/login', function(){
    return view('login');
});
Route::get('/sampledash', function(){
    return view('dashboard');
});
Route::get('/loginotp', function(){
    return view('loginotp');
});

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



Route::get('guestdashboard', function(){
     guestAuthCheck();
    return view('guest.dashboard');
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
    ->latest('core1_reservation.created_at')
    ->get();
  return view('guest.myreservation', ['reserverooms' => $reserverooms]);
});






