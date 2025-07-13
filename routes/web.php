<?php

use App\Http\Controllers\ecmController;
use App\Http\Controllers\hmpController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\roomController;
use App\Models\Ecm;
use App\Models\Hmp;
use App\Models\Inventory;
use App\Models\room;
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

    return view('admin.hmp', ['hmpdata' => $hmpdata]);
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
    $inventory = Inventory::latest()->get();
    return view ('admin.ias', ['inventory' => $inventory]);
});
Route::post('/createinventory', [inventoryController::class, 'store']);