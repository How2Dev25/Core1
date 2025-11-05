<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class hotelBilling extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'billing_hotel';

     protected $primaryKey = 'billingID';

      protected $fillable = [
        'transactionID',
        'transaction_reference',
        'guestID',
        'guestname',
        'payment_date',
        'amount_paid',
        'payment_status',
        'remarks',
        'payment_method',
    ];

       protected static function boot()
    {
        parent::boot();

        static::creating(function ($billing) {
            if (empty($billing->transactionID)) {
                $billing->transactionID = 'TXN-' . strtoupper(Str::random(10));
            }
        });
    }

}
