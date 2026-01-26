<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class roomtypes extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'core1_roomtypes';

     protected $primaryKey = 'roomtypesID';

    protected $fillable = [
        'roomtypesID',
        'roomtype_name',
        'roomtype_description',
    ];
}
