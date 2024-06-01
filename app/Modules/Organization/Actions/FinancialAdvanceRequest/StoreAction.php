<?php
namespace Organization\Actions\FinancialAdvanceRequest;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Organization\Models\{Employee, FinancialAdvanceRequest,Notification};
class StoreAction
{
    public function execute(Request $request):void
    {

        if (!$request->has('empId')){

            $record =  FinancialAdvanceRequest::create([

                'employee_id' => auth('organization_admin')->user()->employee->id,
                'date' => $request->input('date'),
                'note' => $request->input('note'),
                'amount' => $request->input('amount'),
            ]);


            $notification = new Notification(); 
$notification->model_type  = 'FinancialAdvanceRequest';
$notification->model_id   = $record->id ;
$notification->body = 'قدم الموظف '.' '.$record->employee->name .'  صاحب رقم الهاتف ' .$record->employee->phone .'  طلب سلفة';
$notification->save();



        }

        else{

$employee = Employee::FindOrFail($request->empId);


$record =  FinancialAdvanceRequest::create([

    'employee_id' => $employee->id,
    'date' => $request->input('date'),
    'note' => $request->input('note'),
    'amount' => $request->input('amount'),
]);

$notification = new Notification(); 
$notification->model_type  = 'FinancialAdvanceRequest';
$notification->model_id   = $record->id ;
$notification->body = 'قدم الموظف '.' '.$record->employee->name .'  صاحب رقم الهاتف ' .$record->employee->phone .'  طلب سلفة';
$notification->save();


}


        }

}

