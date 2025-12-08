<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class doorlockFrontdesk extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'doorlockfrontdesk';

     protected $primaryKey =  'doorlockfrontdeskID';

     protected $fillable = [
        'doorlockfrontdeskID',
        'guestID',
        'bookingID',
        'guestname',
        'doorlockfrontdesk_status',
        'doorlockID',
     ];
}
