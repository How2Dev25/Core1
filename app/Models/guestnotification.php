<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class guestnotification extends Model
{
       use HasFactory, Notifiable;


        protected $table = 'guestnotification';
        protected $primaryKey = 'notificationguestID';

        protected $fillable = [
            'notificationguestID',
            'guestID',
            'module',
            'guestname',
            'topic',
            'message',
            'status'
        ];
}
