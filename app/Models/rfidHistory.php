<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class rfidHistory extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'rfid_history';
     protected $primaryKey =  'doorlockID';

     protected $fillable = [
        'rfidhistoryID',
        'doorlockID',
        'door_state',
    ];
}
