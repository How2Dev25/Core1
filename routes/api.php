<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\doorlockController;
use App\Http\Controllers\roomController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



// integration with Admin 

// events
Route::get('/core1events', [ApiController::class, 'events'] );
// User Management
Route::get('/accounts', [ApiController::class, 'hotelaccounts']);
Route::get('/hoteldeptlogs', [ApiController::class, 'hoteldeptLogs']);
Route::get('/hotelaudittrails', [ApiController::class, 'hotelaudit']);

// integration With  Financials
Route::get('/core1financials', [ApiController::class, 'hotelincome']);

// integration with Logistics 2 
Route::get('/core1stockrequest', [ApiController::class, 'stockrequest']);

// integration with resto

Route::get('/restobillingandpayments', [ApiController::class, 'fetchrestobillingandpayments']);



// rooms 
Route::get('/core1rooms', [ApiController::class, 'rooms'] );

// Events
Route::get('/facilities', [ApiController::class, 'facility']);

// door lock

Route::post('/scan-rfid', [ApiController::class, 'scanRfid']);

Route::get('/doorlock-status/{doorlockID}', [ApiController::class, 'checkDoorlockStatus']);


// Core Human 
Route::get('/requestemployee', [ApiController::class, 'requestEmployee']);
Route::put('/approverequest/{requestempID}', [ApiController::class, 'approveEmployeeRequest']);
Route::put('/rejectrequest/{requestempID}', [ApiController::class, 'rejectEmployeeRequest']);

Route::get('/reportEmployee', [ApiController::class, 'reportEmployee']);
Route::put('/resolvedEmployee/{reportID}', [ApiController::class, 'resolvedEmployee']);