<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncQueue extends Model
{
    use HasFactory;

    protected $table = 'sync_queue';

    protected $fillable = [
        'model_name',
        'record_id',
        'action',
        'payload',
        'synced',
    ];

    protected $casts = [
        'payload' => 'array',
        'synced'  => 'boolean',
    ];
}
