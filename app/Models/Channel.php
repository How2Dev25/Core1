<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Channel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'channel_table';

    protected $primaryKey = 'channelID';

    protected $fillable = [
        'channelID',
        'roomID',
        'channelName',
        'channelStatus',
    ];
}
