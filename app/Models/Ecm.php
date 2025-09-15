<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Ecm extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'core1_ecm';

    protected $primaryKey = 'eventbookingID';

        protected $fillable = [
            'eventbookingID',
            'eventtype_ID',
            'eventstatus',
            'eventorganizer_email',
            'eventorganizer_name',
            'eventorganizer_phone',
            'event_name',
            'event_specialrequest',
            'event_equipment',
            'event_paymentstatus',
            'event_paymentmethod',
            'event_bookedate',
            'event_checkin',
            'event_checkout',
            'guestID',
            'event_eventreceipt',
            'event_bookingreceiptID',
            'event_numguest',
        ];

}
