<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;


class AuditTrails extends Model
{
    use HasFactory, Notifiable, Syncable;

    protected $table = 'dept_audit_trail_transaction';
    protected $primaryKey = 'at_id';

    protected $fillable = [
        'at_id',
        'dept_id',
        'dept_name',
        'modules_cover',
        'action',
        'activity',
        'employee_name',
        'employee_id',
        'role',
        'date',
    ];

     public $timestamps = false;


    public function deptAccount()
{
    return $this->belongsTo(DeptAccount::class, 'employee_id', 'employee_id');
}

}
