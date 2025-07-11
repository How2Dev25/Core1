<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Hmp extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'core1_hmp';
    protected $primaryKey = 'promoID';

    protected $fillable = [
        'promoID',
        'hotelpromophoto',
        'hotelpromoname',
        'hotelpromotag',
        'hotelpromodaterange',
        'hotelpromostatus',
        'hotelpromodescription',
      
    ];

}
