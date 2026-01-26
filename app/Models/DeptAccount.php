<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;
class DeptAccount extends Authenticatable
{
    use Notifiable, Syncable;

    protected $table = 'department_accounts';
    protected $primaryKey = 'Dept_no';

      public $timestamps = false; // ✅ Add this line
  

    protected $fillable = [
        'Dept_no',
        'Dept_id',
        'dept_name',
        'employee_name',
        'employee_id',
        'role',
        'email',
        'status',
        'password',
        'is_locked',
        'locked_until',
        'otp_failed_attempts',
        'last_otp_attempt',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];



public function additionalInfo()
{
    return $this->hasOne(additionalinfoadmin::class, 'Dept_no', 'Dept_no');
}

/**
 * Check if account is currently locked
 */
public function isLocked()
{
    return $this->is_locked;
}

/**
 * Lock the account permanently
 */
public function lockAccount()
{
    $this->update([
        'is_locked' => true,
        'locked_until' => null, // No automatic unlock
        'otp_failed_attempts' => 0,
    ]);
}

/**
 * Unlock the account
 */
public function unlockAccount()
{
    $this->update([
        'is_locked' => false,
        'locked_until' => null,
        'otp_failed_attempts' => 0,
        'last_otp_attempt' => null,
    ]);
}

/**
 * Increment OTP failed attempts
 */
public function incrementOtpFailedAttempts()
{
    $this->increment('otp_failed_attempts');
    $this->update(['last_otp_attempt' => now()]);
    
    // Lock account after 5 failed attempts
    if ($this->otp_failed_attempts >= 5) {
        $this->lockAccount();
        return true; // Account locked
    }
    
    return false; // Account not locked yet
}

/**
 * Reset OTP failed attempts
 */
public function resetOtpFailedAttempts()
{
    $this->update([
        'otp_failed_attempts' => 0,
        'last_otp_attempt' => null,
    ]);
}
}