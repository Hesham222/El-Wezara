<?php
namespace Organization\Actions\PointOfSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\Order;
use Organization\Models\PointOfSaleOrderSheet;


class EndShiftAction
{
    public function execute(Request $request)
    {
        $record = PointOfSaleOrderSheet::FindOrFail($request->input('shift'));
        $orderAmount = Order::select('total_amount')->where([ ['organization_admin_id',$record->organization_admin_id],['point_of_sale_id',$record->point_of_sale_id] ])->whereDate('created_at',$record->shift_date)->sum('total_amount');
        $numberOfOrders = Order::select('id')->where([ ['organization_admin_id',$record->organization_admin_id],['point_of_sale_id',$record->point_of_sale_id] ])->whereDate('created_at',$record->shift_date)->count();

        $record->shift_end   = Carbon::now();
        $record->end_balance = $request->input('endBalance');
        $record->ordersAmount = $orderAmount;
        $record->no_of_orders = $numberOfOrders;
        $record->save();

    }
}
