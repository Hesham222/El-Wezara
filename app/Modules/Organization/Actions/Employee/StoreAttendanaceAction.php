<?php
namespace Organization\Actions\Employee;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin,Employee,EmployeeAttendance
};
use Carbon\Carbon;
class StoreAttendanaceAction
{


    public function execute(Request $request)
    {
      //  return dd($request->all());
        $record =  Employee::FindOrFail($request->emp_id);
        $attendanace = EmployeeAttendance::where('employee_id',$record->id)
        ->where('date',$request->date)->first();
       // $checkIn = Carbon::parse($request->checkIn .' '. $request->checkIn);
//$checkOut = Carbon::parse($request->checkOut .' '. $request->checkOut);

        if ( $attendanace) {
        	$attendanace->checkIn = $request->checkIn;
            $attendanace->checkOut = $request->checkOut;
        	$attendanace->overTimeDuration = $request->overTimeDuration;
      //  $attendanace->overTimeDuration = $request->checkOut - $request->checkIn;
        	$attendanace->save();
        }else{
$attendanace = new EmployeeAttendance();
$attendanace->employee_id  = $request->emp_id;
$attendanace->date = $request->date;
$attendanace->checkIn = $request->checkIn;
        	$attendanace->checkOut = $request->checkOut;
        	$attendanace->overTimeDuration = $request->overTimeDuration;
           // $attendanace->overTimeDuration = $request->checkOut - $request->checkIn;
            $attendanace->save();



        }
      
    }
}