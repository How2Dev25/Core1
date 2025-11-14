<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class channelListings extends Model
{
     use HasFactory, Notifiable;

     protected $table = 'channel_listing';

     protected $primaryKey = 'channelListingID';

     protected $fillable = [
        'channelListingID',
        'channelName',
        'channelPhoto',
        'channelDescription',
        'channelStatus',
     ];

     public function listings()
{
    return $this->hasMany(Channel::class, 'channelListingID', 'channelListingID');
}
}
