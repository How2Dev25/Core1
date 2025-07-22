<?php

use App\Http\Controllers\channelController;
use App\Http\Controllers\ecmController;
use App\Http\Controllers\hmpController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\roomController;
use App\Http\Controllers\roommantenanceController;
use App\Http\Controllers\stockController;
use App\Models\Channel;
use App\Models\Ecm;
use App\Models\Hmp;
use App\Models\Inventory;
use App\Models\room;
use App\Models\room_maintenance;
use App\Models\stockRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


// Login 
Route::get('/login', function(){
    return view('login.login');
});

// Register
Route::get('/guestregister', function(){
    return view('guestregister.register');
});

// 401 page
Route::get('/errorpage', function(){
    return view('error.restricted');
});


// Admins

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

// Room Management
Route::get('/roommanagement', function(){
    $totalrooms = room::count();
    $occupiedrooms = room::where('roomstatus', 'Occupied')->count();
    $availablerooms = room::where('roomstatus', 'Available')->count();
    $maintenancerooms = room::where('roomstatus', 'Maintenance')->count();
    $rooms = room::latest()->get();
    return view('admin.roomanagement', ['rooms' => $rooms, 
    'occupiedrooms' =>  $occupiedrooms,
    'availablerooms' => $availablerooms,
     'maintenancerooms' => $maintenancerooms,
    'totalrooms' => $totalrooms ]);
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
    return view('admin.channel', ['rooms' => $rooms, 'channels' => $channels]);
});

Route::post('/createlisting', [channelController::class, 'store']);
Route::put('/updatelisting/{channelID}', [channelController::class, 'modify']);
Route::delete('/deletelisting/{channelID}', [channelController::class, 'delete']);
