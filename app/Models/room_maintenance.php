<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class room_maintenance extends Model
{
  use HasFactory, Notifiable, Syncable;

  protected $table = 'core1_roommaintenance';
  protected $primaryKey = 'roommaintenanceID';

  protected $fillable = [
    'roommaintenanceID',
    'roomID',
    'maintenancedescription',
    'maintenancestatus',
    'maintenanceassigned_To',
    'maintenance_priority',
  ];
}
