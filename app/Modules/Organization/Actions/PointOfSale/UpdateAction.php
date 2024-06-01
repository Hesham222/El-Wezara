<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;
use Organization\Models\{LaundryService,
    LService,
    PointOfSale,
    PointOfSaleEmployee,
    PointOfSaleItems,
    PreparationArea,
    PreparationAreaCategory,
    PreparationAreaEmployee};

class UpdateAction
{
    public function execute(Request $request, $id)
    {
        $record = PointOfSale::find($id);
        $record->name = $request->input('name');
        $record->manager_id = $request->input('manager_id');
        $record->save();

        if ($request->input('items')) {
            $record->PointOfSaleItems()->delete();
            foreach ($request->input('items') as $category)
            {
                PointOfSaleItems::create([
                    'PointOfSale_id' => $record->id,
                    'item_id' => $category
                ]);
            }
        }


        if ($request->input('employees')) {
            $record->PointOfSaleEmployees()->delete();
            foreach ($request->input('employees') as $employee)
            {
                PointOfSaleEmployee::create([
                    'PointOfSale_id' => $record->id,
                    'employee_id' => $employee
                ]);
            }


            return $record;
        }
    }
}
