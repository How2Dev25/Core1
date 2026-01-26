<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Syncable;
class facility extends Model
{
       use HasFactory, Syncable;

    protected $table = 'core1_facility';
    protected $primaryKey = 'facilityID';

    protected $fillable = [
        'facilityID',
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
