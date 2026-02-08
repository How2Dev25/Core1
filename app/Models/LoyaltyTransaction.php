<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoyaltyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'guestID',
        'transaction_type',
        'points_change',
        'amount',
        'reference_type',
        'reference_id',
        'description',
        'transaction_date',
        'points_balance_after',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    /**
     * Get the guest that owns the transaction
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guestID');
    }

    /**
     * Scope to get earned points
     */
    public function scopeEarned($query)
    {
        return $query->where('transaction_type', 'earned');
    }

    /**
     * Scope to get redeemed points
     */
    public function scopeRedeemed($query)
    {
        return $query->where('transaction_type', 'redeemed');
    }

    /**
     * Scope to get bonus points
     */
    public function scopeBonus($query)
    {
        return $query->where('transaction_type', 'bonus');
    }
}
