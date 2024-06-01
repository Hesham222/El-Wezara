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
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  PointOfSale::create([
            'name'                      => $request->input('name'),
            'manager_id'               => $request->input('manager_id'),
        ]);

        foreach ($request->input('items') as $category)
        {
            PointOfSaleItems::create([
                'PointOfSale_id' => $record->id,
                'item_id' => $category
            ]);
        }

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
