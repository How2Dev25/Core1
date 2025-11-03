<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class loyaltyrules extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'loyaltyrules';

    protected $primaryKey = 'loyaltyrulesID';

    protected $fillable = [
        'loyaltyrulesID',
        'points_required',
        'discount_percent',
        'loyalty_rule_status',
    ];
}
