<?php
namespace Organization\Actions\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscription
};
class CancelAction
{
    public function execute(Request $request)
    {

        $record =  Subscription::where('id',$request->input('record_id'))->update([

           'reason_of_cancelled'    => $request->input('reason_of_cancelled'),
           'attendance'             => $request->input('attendance'),
           'rest_of_paid'           => $request->input('rest_of_paid'),
           'attendance_price'       => $request->input('attendance_price'),
           'commission'             => $request->input('commission'),
           'amount_after_discount'  => $request->input('amount_after_discount'),
           'cancelled'              => 1,
           'cancelled_at'          => carbon::now()->format('Y-m-d h:i'),
           'cancelled_by'          => auth('organization_admin')->user()->id,
        ]);

        return $record;
    }
}
