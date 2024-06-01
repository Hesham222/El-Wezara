<?php
namespace Organization\Actions\ExternalPayment;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPayment
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = ExternalPayment::find($id);
        $record->subscriber_id              = $request->input('subscriber_id');
        $record->external_reservation_id    = $request->input('external_reservation_id');
        $record->payment_amount             = $request->input('payment_amount');
        $record->payment_method             = $request->input('payment_method');
        $record->save();
        return $record;
    }
}
