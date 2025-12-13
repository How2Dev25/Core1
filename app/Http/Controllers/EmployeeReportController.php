<?php

namespace App\Http\Controllers;

use App\Models\EmployeeReport;
use App\Models\requestEmployee;
use Illuminate\Http\Request;

class EmployeeReportController extends Controller
{
   public function store(Request $request)
    {
        $form= $request->validate([
            'employee_id'    => 'required|string',
            'employee_name'  => 'required|string',
            'position'       => 'required|string',
            'department'     => 'required|string',
            'last_date'      => 'required|date',
            'days_absent'    => 'required|integer|min:1',
            'actions_taken'  => 'nullable|string',
        ]);

        $form['report_code'] = EmployeeReport::generateReportCode();

        EmployeeReport::create($form);

        return redirect()->back()->with('success', 'Employee report submitted successfully.');
    }

    public function remove(EmployeeReport $reportID){

        $reportID->delete();

        return redirect()->back()->with('success', 'Employee report deleted successfully.');
    }

}
