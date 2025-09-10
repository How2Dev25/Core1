<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class restointegration extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'resto_integration';

    protected $primaryKey = 'menuID';

    protected $fillable = [
        'menuID',
        'menu_name',
        'menu_description', 
        'menu_photo',
        'menu_price',
        'menu_status',
    ];
}
