<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class facility extends Model
{
       use HasFactory;

    protected $table = 'facilities';
    protected $primaryKey = 'facilityID';

    protected $fillable = [
        'facility_name',
        'facility_capacity',
        'facility_type',
        'facility_amenities',
        'facility_status',
        'facility_description',
        'facility_photo', 
    ];

    protected $casts = [
        'facility_amenities' => 'array',
    ];

    public function eventTypes()
    {
        return $this->hasMany(ecmtype::class, 'facilityID', 'facilityID');
    }
}
