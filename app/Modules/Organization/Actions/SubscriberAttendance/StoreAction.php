<?php
namespace Organization\Actions\SubscriberAttendance;
use Illuminate\Http\Request;
use Organization\Models\Subscription;
use Organization\Models\{
    SubscriberAttendance
};
class StoreAction
{
    public function execute(Request $request)
    {
        $subscription = Subscription::where('subscriber_id',$request->input('subscriber_id'))->first();

        $record =  SubscriberAttendance::create([

            'subscription_id'           => $subscription->id,
            'subscriber_id'             => $request->input('subscriber_id'),
            'phone'                     => $request->input('phone'),
            'training_id'               => $request->input('training_id'),
            'train_time'                => $request->input('train_time'),
            'day'                       => $request->input('day'),
            'attendance'                => $request->input('attendance'),
        ]);

        $session = Subscription::where(['subscriber_id'=>$record->subscriber_id,'training_id'=>$record->training_id])->first();

        Subscription::where(['subscriber_id'=>$record->subscriber_id,'training_id'=>$record->training_id])->update([
            'current_session' => $session->current_session - 1
        ]);
        return $record;
    }
}
