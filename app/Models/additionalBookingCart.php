<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class additionalBookingCart extends Model
{
     use HasFactory, Notifiable, Syncable;

       protected $table = 'additionalsbookingcart';

       protected $primaryKey = 'additionalsID';

       protected $fillable = [
        'additionalsID',
        'reservationID',
        'core1_inventoryID',
        'additional_total',
        'additional_quantity',
        'employeeID',
       ];
}
