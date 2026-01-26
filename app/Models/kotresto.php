<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class kotresto extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'kot_orders';

     protected $primaryKey = 'kot_id';

     protected $fillable = [
    'kot_id',
    'order_id',
    'table_number',
    'item_name',
    'quantity',
    'special_instructions',
    'status',
    'created_at',
    'updated_at',
    'orders',
    'table_id',
    'menu_id'
];
}
