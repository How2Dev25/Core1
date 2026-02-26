<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class masterRFID extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'masterRFID';

     protected $primaryKey = 'masterotp_ID';

     protected $fillable = [
        'masterRFID_ID',
        'masterRFID_rfid',
        'masterRFID_name',
        'masterRFID_status',
     ];

}
