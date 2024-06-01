<?php
namespace Organization\Actions\Subscription;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscription
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = Subscription::find($id);

        $record->subscriber_id              = $request->input('subscriber_id');
        $record->training_id                = $request->input('training_id');
        $record->pricing_name               = $request->input('pricing_name');
        $record->price                      = $request->input('price');
        $record->overpriced                 = $request->input('overpriced');
        $record->session_balance            = $request->input('session_balance');
        $record->current_session            = $request->input('current_session');
        $record->start_date                 = $request->input('start_date');
        $record->end_date                   = $request->input('end_date');
        $record->payment_balance            = $request->input('payment_balance');
        $record->paid_date                  = $request->input('paid_date');
        $record->save();
        return $record;
    }
}
