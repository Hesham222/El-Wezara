<?php
namespace Organization\Actions\PreparationArea;
use Illuminate\Http\Request;
use Organization\Models\{LaundryService, LService, PreparationArea, PreparationAreaCategory, PreparationAreaEmployee};
class StoreAction
{
    public function execute(Request $request)
    {


        if ($request->has('hasManufactured')){

            $record =  PreparationArea::create([
                'name'                      => $request->input('name'),
                'employee_id'               => $request->input('employee_id'),
                'hasManufactured'               => 1,
            ]);
        }else{
            $record =  PreparationArea::create([
                'name'                      => $request->input('name'),
                'employee_id'               => $request->input('employee_id'),
            ]);

        }



            PreparationAreaCategory::create([
                'area_id' => $record->id,
                'category_id' => $request->input('categories')
            ]);


        foreach ($request->input('employees') as $employee)
        {
            PreparationAreaEmployee::create([
                'area_id' => $record->id,
                'employee_id' => $employee
            ]);
        }


        return $record;
    }
}
