<?php
namespace Organization\Actions\Laundry;
use Illuminate\Http\Request;
use Organization\Models\{
    laundry
};
use Organization\Models\LaundryEmployee;

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = laundry::find($id);

        $record->name                       = $request->input('name');
        $record->head_id                    = $request->input('head_id');
        $record->description                = $request->input('description');
        $record->save();


        foreach ($request['employee_id'] as $key => $value) {

            if(!empty($value)){

                $employee = new LaundryEmployee();
                $employee->laundry_id   = $record->id;
                $employee->employee_id  = $value;
                $employee->save();
            }
        }
        return $record;
    }
}
