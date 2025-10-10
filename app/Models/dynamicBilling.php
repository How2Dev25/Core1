<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class dynamicBilling extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'dynamic_billing';

     protected $primaryKey = 'dynamic_billingID';

     protected $fillable = [
        'dynamic_billingID',
        'dynamic_name',
        'dynamic_price',
        'dynamic_billing_description',
     ];
}
