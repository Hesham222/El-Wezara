<?php
namespace Organization\Actions\PointOfSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\Order;
use Organization\Models\PointOfSaleOrderSheet;


class EndOrderAction
{
    public function execute($id)
    {
        $record = Order::FindOrFail($id);
        $record->status = "closed";
        $record->save();
    }
}
