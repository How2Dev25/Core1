<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class additionalRoom extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'core1_roomphotos';
    protected $primaryKey = 'roomphotoID';

    protected $fillable = [
        'roomphotoID',
        'additionalroomphoto',
        'roomID',
    ];

}
