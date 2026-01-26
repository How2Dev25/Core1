<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class reportPost extends Model
{
    use HasFactory, Notifiable, Syncable;

    protected $table = 'reportpost';

    protected $primaryKey = 'reportpostID';

    protected $fillable = [
        'reportpostID',
        'postID',
        'reportpost_details',
        'reportpost_reason',
    ];
}
