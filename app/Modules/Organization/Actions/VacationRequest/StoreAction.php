<?php
namespace Organization\Actions\VacationRequest;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Organization\Models\{Employee, VacationRequest};

use Organization\Models\Notification;

class StoreAction
{
    public function execute(Request $request)
    {

        $start = Carbon::parse($request->start_date);


        $fdate = $request->start_date;
        $tdate = $request->end_date;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');//now do whatever you like with $days


        $actual_num_of_days = 0;

        for ($i=1;$i<=$days;$i++){

            if ($i == 1){
                if (date('l', strtotime($start)) == 'Friday')
                {
                    continue;
                }elseif (date('l', strtotime($start)) == 'Saturday')
                {
                    continue;
                }else{$actual_num_of_days++;}


            }else{

                $new_date = $start->addDays(1);
                if (date('l', strtotime($new_date)) == 'Friday')
                {
                    continue;
                }elseif (date('l', strtotime($new_date)) == 'Saturday')
                {
                    continue;
                }else{$actual_num_of_days++;}

            }

        }


        $record = null ;

        if (!$request->has('empId')){


            $vacation_balance = auth('organization_admin')->user()->employee->vacation_balance;


            if ($actual_num_of_days > $vacation_balance ){
                return 0;
            }

            $record =  VacationRequest::create([

                'employee_id' => auth('organization_admin')->user()->employee->id,
                'employee_vacation_type_id' => $request->input('employee_vacation_type'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'note' => $request->input('note'),
                'vacation_duration' => $actual_num_of_days,
            ]);

            $notification = new Notification(); 
$notification->model_type  = 'VacationRequest';
$notification->model_id   = $record->id ;
$notification->body = 'قدم الموظف '.' '.$record->employee->name .'  صاحب رقم الهاتف ' .$record->employee->phone .'  طلب اجازة';
$notification->save();

            return 1;

        }

        else{

$employee = Employee::FindOrFail($request->empId);
$vacation_balance = $employee->vacation_balance;


if ($actual_num_of_days > $vacation_balance ){
return 0;
}

$record =  VacationRequest::create([

    'employee_id' => $employee->id,
    'employee_vacation_type_id' => $request->input('employee_vacation_type'),
    'start_date' => $request->input('start_date'),
    'end_date' => $request->input('end_date'),
    'note' => $request->input('note'),
    'vacation_duration' => $actual_num_of_days,
]);

$notification = new Notification(); 
$notification->model_type  = 'VacationRequest';
$notification->model_id   = $record->id ;
$notification->body = 'قدم الموظف '.' '.$record->employee->name .'  صاحب رقم الهاتف ' .$record->employee->phone .'  طلب اجازة';
$notification->save();

return 1;

}




        }

       
}

