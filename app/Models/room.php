<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class room extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'core1_room';
     protected $primaryKey = 'roomID';

     protected $fillable = [
        'roomID',
        'roomtype',
        'roomsize',
        'roommaxguest',
        'roomfeatures',
        'roomdescription',
        'roomphoto',
        'roomprice',
        'roomstatus',
     ];

}
