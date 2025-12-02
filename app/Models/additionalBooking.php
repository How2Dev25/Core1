<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class additionalBooking extends Model
{

     use HasFactory, Notifiable;

     protected $table = 'additional_booking';

     protected $primaryKey = 'additionalbookingID';
    protected $fillable = [
        'reservationID',
        'core1_inventoryID',
        'additional_total',
        'additional_quantity',
        'addon_status',
    ];
}
