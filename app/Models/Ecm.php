<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Ecm extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'core1_ecm';

    protected $primaryKey = 'eventID';

    protected $fillable = [
        'eventID',
        'eventphoto',
        'eventname',
        'eventtype',
        'eventorganizername',
        'eventcontactemail',
        'eventcontactnumber',
        'eventdate',
        'event_time_start',
        'event_time_end',
        'event_time_end',
        'eventneedroombooking',
        'eventequipment',
        'eventspecialrequest',
        'eventstatus',
        'eventdays',
        'eventexpectedguest',
       
    ];
}
