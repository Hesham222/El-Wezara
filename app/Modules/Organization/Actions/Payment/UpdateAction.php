<?php
namespace Organization\Actions\Payment;
use Illuminate\Http\Request;
use Organization\Models\{
    Payment
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = Payment::find($id);
        $record->subscriber_id      = $request->input('subscriber_id');
        $record->subscription_id    = $request->input('description');
        $record->payment_balance    = $request->input('payment_balance');
        $record->payment_amount     = $request->input('payment_amount');
        $record->payment_method     = $request->input('payment_method');
        $record->save();
        return $record;
    }
}
