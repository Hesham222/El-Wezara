<?php
namespace Organization\Actions\Employee;
use Illuminate\Http\Request;
use Organization\Models\Employee;
use Organization\Models\LeaveUnpaid;

class StoreUnpaidVacationAction
{
    public function execute(Request $request)
    {
        $record   =  LeaveUnpaid::create([
            'employee_id'                       => $request->input('employee_id'),
            'leave_reason'                      => $request->input('leave_reason'),
            'work_years'                        => $request->input('work_years'),
            'leave_date'                        => $request->input('leave_date'),
            'leave_return'                      => $request->input('leave_return'),
        ]);

        Employee::where('id',$record->employee_id)->update([
           'leave_unpaid_status' => 1,
        ]);

        return $record;
    }
}
