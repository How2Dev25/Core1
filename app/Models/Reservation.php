<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;


class Reservation extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'core1_reservation';

     protected $primaryKey  = 'reservationID';

            protected $fillable = [
            'reservationID',
            'roomID',
            'reservation_checkin',
            'reservation_checkout',
            'bookedvia',
            'reservation_specialrequest',
            'early_checkin_time',
            'late_checkout_time',
            'reservation_numguest',
            'reservation_adults',
            'reservation_children',
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
            'payment_status',
            'subtotal',
            'vat',
            'serviceFee',
            'total',
            'loyalty_points_used',
            'loyalty_discount',
            'reservation_validID',
            'deposit_amount',
            'balance_remaining',
        ];
}
