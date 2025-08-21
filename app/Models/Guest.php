<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guest extends Authenticatable
{
    use Notifiable;

    protected $table = 'core1_guest';
    protected $primaryKey = 'guestID';

    protected $fillable = [
        'guest_email',
        'guest_name',
        'guest_photo',
        'guest_address',
        'guest_mobile',
        'guest_password',
        'guest_birthday',
    ];

    protected $hidden = [
        'guest_password', 'remember_token',
    ];

    // Use guest_password for authentication instead of default 'password'
    public function getAuthPassword()
    {
        return $this->guest_password;
    }
}
