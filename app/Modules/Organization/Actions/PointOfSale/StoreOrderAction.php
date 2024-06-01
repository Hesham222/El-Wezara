<?php
namespace Organization\Actions\PointOfSale;
use Illuminate\Http\Request;
use Organization\Models\{LaundryService,
    LService,
    Order,
    PointOfSale,
    PointOfSaleEmployee,
    PointOfSaleItems,
    PreparationArea,
    PreparationAreaCategory,
    PreparationAreaEmployee};
class StoreOrderAction
{
    public function execute(Request $request)
    {

        $record =  Order::create([
            'organization_admin_id'                      => auth('organization_admin')->user()->id,
            'point_of_sale_id'               => $request->input('point_of_sale_id'),
            'point_of_sale_order_sheet_id'               => $request->input('point_of_sale_order_sheet_id'),
            'total_amount'               => $request->input('final_price'),
            'table_number'               => $request->input('table_number'),
            'status'               => "sentToPrepration",
        ]);


        return $record;
    }
}
