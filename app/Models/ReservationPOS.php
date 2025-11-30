<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationPOS extends Model
{

     protected $table = 'reservationPOS';

     protected $primaryKey = 'reservationposID';
      protected $fillable = [
        'reservationposID',
        'roomID',
        'reservation_checkin',
        'reservation_checkout',
        'reservation_specialrequest',
        'reservation_numguest',
        'guestname',
        'guestphonenumber',
        'guestemailaddress',
        'guestbirthday',
        'guestaddress',
        'guestcontactperson',
        'guestcontactpersonnumber',
        'subtotal',
        'vat',
        'serviceFee',
        'total',
        'employeeID',
    ];
}
