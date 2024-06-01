<?php
namespace Organization\Actions\PreparationArea;
use Illuminate\Http\Request;
use Organization\Models\{LaundryService, LService, PreparationArea, PreparationAreaCategory, PreparationAreaEmployee};

class UpdateAction
{
    public function execute(Request $request, $id)
    {
        $record = PreparationArea::find($id);
        $record->name = $request->input('name');
        $record->employee_id = $request->input('employee_id');
        $record->save();
        if ($request->input('categories')) {
            $record->PreparationAreaCategories()->delete();
                PreparationAreaCategory::create([
                    'area_id' => $record->id,
                    'category_id' => $request->input('categories')
                ]);
            }


        if ($request->input('employees')) {
            $record->PreparationAreaEmployees()->delete();
            foreach ($request->input('employees') as $employee) {
                PreparationAreaEmployee::create([
                    'area_id' => $record->id,
                    'employee_id' => $employee
                ]);
            }


            return $record;
        }
    }
}
