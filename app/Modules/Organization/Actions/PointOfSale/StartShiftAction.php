<?php
namespace Organization\Actions\PointOfSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\PointOfSaleOrderSheet;


class StartShiftAction
{
    public function execute(Request $request)
    {
        $record =  PointOfSaleOrderSheet::create([
            'organization_admin_id'        => auth('organization_admin')->user()->id,
            'point_of_sale_id'           => $request->input('point_of_sale'),
            'shift_date'        => Carbon::now()->format('Y-m-d'),
            'shift_start'       => Carbon::now(),
            'start_balance'     => $request->input('startBalance'),
        ]);
        return $record;
    }
}
