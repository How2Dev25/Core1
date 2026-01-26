<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class doorlock extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'doorlock'; 

     protected $primaryKey = 'doorlockID';


     protected $fillable = [
        'doorlockID',
        'rfid',
        'doorlock_status',
        'roomID',
     ];
}
