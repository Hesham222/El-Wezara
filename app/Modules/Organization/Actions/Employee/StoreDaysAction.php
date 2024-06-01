<?php
namespace Organization\Actions\Employee;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{EmployeeWorkingDay, OrganizationAdmin, Employee};
class StoreDaysAction
{


    public function execute(Request $request): void
    {

        $record =  Employee::FindOrFail($request->id);
        $emp_working_days_months = EmployeeWorkingDay::where('employee_id',$record->id)->get();
            $counter = 0;
        foreach ($emp_working_days_months as $emp_working_days_month){
            if (date("m", strtotime($emp_working_days_month->date)) == date("m",strtotime($request->date))){
               $emp_working_days_month->delete();
               $new_emp_working_days_month = new EmployeeWorkingDay();
                $new_emp_working_days_month->employee_id  = $record->id ;
                $new_emp_working_days_month->working_days  = $request->working_days ;
                $new_emp_working_days_month->date  = $request->date ;
                $new_emp_working_days_month->save();
                $counter++;
            }else{continue;

            }
        }
if ($counter == 0){
    $new_emp_working_days_month = new EmployeeWorkingDay();
    $new_emp_working_days_month->employee_id  = $record->id ;
    $new_emp_working_days_month->working_days  = $request->working_days ;
    $new_emp_working_days_month->date  = $request->date ;
    $new_emp_working_days_month->save();
}


    }
}
