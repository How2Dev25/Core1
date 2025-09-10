<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class restoCart extends Model
{
 use HasFactory, Notifiable;
    protected $table = 'resto_cart';
    protected $primaryKey = 'cartID';
    
      protected $fillable = [
        'cartID',
        'menuID',
        'bookingID',
        'order_quantity',
        'order_status',
        'guestID',
        'orderguest_name',
        'orderguest_email',
        'orderguest_contact',
     ];
}
