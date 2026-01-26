<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;


class requestEmployee extends Model
{
       use HasFactory, Syncable;

        protected $table = 'requestemployee';

        protected $primaryKey = 'requestempID';
         protected $fillable = [
        'requestempID',
        'request_id',
        'department',
        'requested_by',
        'position',
        'quantity',
        'employment_type',
        'shift',
        'reason',
        'status',
    ];

   public static function generateRequestId()
{
    // Use your actual primary key for latest()
    $latest = self::latest('requestempID')->first();

    if (!$latest) {
        return 'RE-001';
    }

    // Extract number from last request_id
    $lastId = (int) str_replace('RE-', '', $latest->request_id);
    $newId = $lastId + 1;

    return 'RE-' . str_pad($newId, 3, '0', STR_PAD_LEFT);
}
}
