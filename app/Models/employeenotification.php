<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;


class employeenotification extends Model
{
    use HasFactory, Notifiable, Syncable;

    protected $table = 'employeenotification';

    protected $primaryKey = 'notificationempID';

    protected $fillable = [
        'notificationempID',
        'module',
        'message',
        'guestname',
        'status',
        'topic',
    ];
}
