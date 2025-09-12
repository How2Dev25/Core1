<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\roomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



// integration with Admin 
// rooms 
Route::get('/core1rooms', [ApiController::class, 'rooms'] );
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






