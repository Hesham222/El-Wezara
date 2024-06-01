<?php
namespace Organization\Actions\EmployeeBonus;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Organization\Models\{Employee, EmployeeBonus};
class StoreAction
{
    public function execute(Request $request):void
    {

        if ($request->has('empId')){

            $employee = Employee::FindOrFail($request->empId);
//upload  id  file
            if ($request->has('attachment'))
                $file = $request->file('attachment')->store('employee_bonus_attachments');
            //$this->storeSingleFile($request->file('attachment'),'employee_attachments');
            else
                $file = null;

            $record =  EmployeeBonus::create([

                'employee_id' => $employee->id,
                'note' => $request->input('note'),
                'amount' => $request->input('amount'),
                'attachment' => $file,
                'status' => $request->input('status'),
            ]);


        }


        }

}

