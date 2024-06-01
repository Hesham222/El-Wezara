<?php
namespace Organization\Actions\Payment;
use Illuminate\Http\Request;
use Organization\Models\{
    Payment
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Payment::create([
            'subscriber_id'         => $request->input('subscriber_id'),
            'subscription_id'       => $request->input('subscription_id'),
            'payment_balance'       => $request->input('payment_balance'),
            'payment_amount'        => $request->input('payment_amount'),
            'payment_method'        => $request->input('payment_method'),
        ]);
        return $record;
    }
}
