<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Glar extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'core1_guestloyaltyandrewards';
     protected $primaryKey = 'guestloyaltyandrewardsID';
     protected $fillable = [
        'guestloyaltyandrewardsID',
        'guestID',
        'loyaltyID',
        'guestemail',
     ];

}
