<?php
namespace Organization\Actions\ExternalPayment;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPayment
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  ExternalPayment::create([
            'subscriber_id'             => $request->input('subscriber_id'),
            'external_reservation_id'   => $request->input('external_reservation_id'),
            'payment_amount'            => $request->input('payment_amount'),
            'payment_method'            => $request->input('payment_method'),
        ]);
        return $record;
    }
}
