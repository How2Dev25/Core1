<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;
class eventPOS extends Model
{
        use Syncable;
     protected $table = 'eventpos';

    protected $primaryKey = 'eventposID';

    protected $fillable = [
        'eventposID',
        'eventtype_ID',
        'eventorganizer_email',
        'eventorganizer_name',
        'eventorganizer_phone',
        'event_name',
        'event_specialrequest',
        'event_equipment',
        'event_paymentmethod',
        'event_checkin',
        'event_checkout',
        'event_numguest',
        'event_total_price',
        'employeeID',
    ];
}
