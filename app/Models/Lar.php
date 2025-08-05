<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Lar extends Model
{
      use HasFactory, Notifiable;

      protected $table = 'core1_loyaltyandrewards';

      protected $primaryKey = 'loyaltyID';

      protected $fillable = [
        'loyaltyID',
        'roomID',
        'loyalty_description',
        'loyalty_value',
        'loyalty_status',
      ];

}
