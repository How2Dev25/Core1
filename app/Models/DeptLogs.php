<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class DeptLogs extends Model
{
     use HasFactory, Notifiable, Syncable;

    protected $table = 'department_logs';

    protected $primaryKey = 'dept_logs_id';

    protected $fillable = [
        'dept_logs_id',
        'dept_id',
        'employee_id',
        'employee_name',
        'log_status',
        'attempt_count',
        'failure_reason',
        'cooldown',
        'date',
        'role',
        'log_type',
    ];

     public $timestamps = false;


 public function deptAccount()
{
    return $this->belongsTo(DeptAccount::class, 'employee_id', 'employee_id');
}

}
