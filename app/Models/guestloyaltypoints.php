<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class guestloyaltypoints extends Model
{
    use HasFactory, Notifiable, Syncable;

    protected $table = 'coreloyaltyandrewards_guest';

    protected $primaryKey = 'loyaltyandrewardsguestID';

    protected $fillable = [
        'guestID',
        'points_balance',
        'points_reserved',
    ];
}
