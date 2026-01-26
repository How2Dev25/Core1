<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\Syncable;

class EmployeeReport extends Model
{
      use Notifiable, Syncable;

      protected $table = 'employee_reports';
      protected $primaryKey =  'reportID';

         protected $fillable = [
          'reportID',
        'report_code',
        'employee_id',
        'employee_name',
        'position',
        'department',
        'last_date',
        'days_absent',
        'actions_taken',
        'status',
    ];

     public static function generateReportCode()
    {
        $latest = self::orderBy('reportID', 'desc')->first();

        if (!$latest) {
            return 'REP-001';
        }

        $number = (int) str_replace('REP-', '', $latest->report_code) + 1;

        return 'REP-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }


}
