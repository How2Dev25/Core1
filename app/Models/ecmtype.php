<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class ecmtype extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'core1_eventtype';

    protected $primaryKey = 'eventtype_ID';

    protected $fillable = [
    'eventtype_ID',
    'eventtype_name',
    'eventtype_photo',
    'eventtype_price',
    'eventtype_description',
    'eventtype_capacity',         // Maximum number of guests
    'facilityID',                 // Linked facility/room
    'eventtype_amenities',        // JSON list of included amenities
    'eventtype_duration',         // Standard duration of the event
    'eventtype_catering_options', // JSON list of catering options
    'eventtype_theme_options',    // JSON list of theme options
    'eventtype_booking_policy',   // Notes/rules for booking
    'eventtype_extra_services',   // JSON list of optional add-ons
    'eventtype_status',           // Active/Inactive
];
    // Cast JSON fields to arrays automatically
    protected $casts = [
        'eventtype_amenities' => 'array',
        'eventtype_catering_options' => 'array',
        'eventtype_theme_options' => 'array',
        'eventtype_extra_services' => 'array',
    ];
}
