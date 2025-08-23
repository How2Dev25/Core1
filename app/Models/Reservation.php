<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Reservation extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'core1_reservation';

     protected $primaryKey  = 'reservationID';

            protected $fillable = [
            'reservationID',
            'roomID',
            'reservation_checkin',
            'reservation_checkout',
            'bookedvia',
            'reservation_specialrequest',
            'reservation_numguest',
            'guestname',
            'guestphonenumber',
            'guestemailaddress',
            'guestbirthday',
            'guestaddress',
            'guestcontactperson',
            'guestcontactpersonnumber',
            'reservation_bookingstatus',
            'reservation_receipt',
            'guestID',
            'payment_method',
            'bookingID',
        ];
}
