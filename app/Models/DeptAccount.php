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
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];



public function additionalInfo()
{
    return $this->hasOne(additionalinfoadmin::class, 'Dept_no', 'Dept_no');
}
}