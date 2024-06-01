<?php
namespace Organization\Actions\Laundry;
use Illuminate\Http\Request;
use Organization\Models\laundry;
use Organization\Models\LaundryEmployee;
use Organization\Models\{
    Subscriber
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  laundry::create([
            'name'                  => $request->input('name'),
            'head_id'               => $request->input('head_id'),
            'description'           => $request->input('description'),
        ]);

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
