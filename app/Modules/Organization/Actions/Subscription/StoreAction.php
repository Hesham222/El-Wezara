<?php
namespace Organization\Actions\Subscription;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscription
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  Subscription::create([
            'subscriber_id'         => $request->input('subscriber_id'),
            'training_id'           => $request->input('training_id'),
            'pricing_name'          => $request->input('pricing_name'),
            'price'                 => $request->input('price'),
            'overpriced'            => $request->input('overpriced'),
            'current_session'       => $request->input('current_session'),
            'session_balance'       => $request->input('session_balance'),
            'payment_balance'       => $request->input('payment_balance'),
            'start_date'            => $request->input('start_date'),
            'end_date'              => $request->input('end_date'),
            'paid_date'             => $request->input('paid_date'),
        ]);
        return $record;
    }
}
