<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class Channel extends Model
{
    use HasFactory, Notifiable, Syncable;

    protected $table = 'channel_table';

    protected $primaryKey = 'channelID';

    protected $fillable = [
        'channelID',
        'roomID',
        'channelListingID',
    ];

    public function channel()
{
    return $this->belongsTo(channelListings::class, 'channelListingID', 'channelListingID');
}
}
