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
class UpdateOrderAction
{
    public function execute(Request $request)
    {

        $record =  Order::where('id',$request->order_id)->update([
            'total_amount'               => $request->input('final_price'),
            'status'               => "sentToPrepration",
        ]);

        $record = Order::find($request->order_id);

        return $record;
    }
}
