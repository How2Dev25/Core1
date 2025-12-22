<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class rfidHistory extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'rfid_history';
     protected $primaryKey =  'doorlockID';

     protected $fillable = [
        'rfidhistoryID',
        'doorlockID',
        'door_state',
    ];
}
