<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class missingRFID extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'missing_rfid';

     protected $primaryKey = 'missingRFID';
     

     protected $fillable = [ 
        'doorlockID',
        'missing_rfid_status',
     ];
}
