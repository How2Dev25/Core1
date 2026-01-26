<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class aiPrompt extends Model
{
     use HasFactory, Notifiable, Syncable;

     protected $table = 'aiprompts';

     protected $primaryKey = 'aipromptsID';

      protected $fillable = [
        'aipromptsID',
        'guestID',
        'prompt_text',
        'roomtype',
        'roommaxguest',
        'roomfeatures',
        'reservation_days',
        'checkin_date',
        'checkout_date',
        'special_request',
        'raw_json',
    ];

      protected $casts = [
        'roomfeatures' => 'array', // automatically casts JSON to array
    ];
}
