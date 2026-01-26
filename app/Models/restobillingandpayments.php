<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class restobillingandpayments extends Model
{
      use HasFactory, Notifiable, Syncable;

      protected $table = 'billing_payments';

      protected $primaryKey = 'BP_id';

      protected $fillable = [
        'BP_id',
        'client_name',
        'client_email',
        'client_contact',
        'invoice_number',
        'invoice_date',
        'due_date',
        'status',
        'description',
        'quantity',
        'unit_price',
        'total_amount',
        'payment_date',
        'payment_amount',
        'MOP',
        'trans_ref',
      ];
}
