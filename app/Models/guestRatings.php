<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class guestRatings extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'core1_rating';

    protected $primaryKey = 'ratingID';

    protected $fillable = [
        'ratingID',
        'rating_name',
        'rating_email',
        'rating_location',
        'rating_description',
        'rating_rating',
    ];
}
