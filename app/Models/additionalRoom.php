<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class additionalRoom extends Model
{
    use HasFactory, Notifiable, Syncable;

    protected $table = 'core1_roomphotos';
    protected $primaryKey = 'roomphotoID';

    protected $fillable = [
        'roomphotoID',
        'additionalroomphoto',
        'roomID',
    ];

}
