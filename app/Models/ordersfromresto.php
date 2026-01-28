<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class ordersfromresto extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'orderfromresto';

     protected $primaryKey = 'orderID';

     protected $fillable = [
        'orderID',
        'menuID',
        'bookingID',
        'order_quantity',
        'order_status',
        'payment_resto_status',
        'payment_method',
        'payment_date',
        'transaction_ref',
        'guestID',
        'orderguest_name',
        'orderguest_email',
        'orderguest_contact',
     ];
}
