<?php
namespace Organization\Actions\SubscriberAttendance;
use Illuminate\Http\Request;
use Organization\Models\{
    SubscriberAttendance
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                            = SubscriberAttendance::find($id);

        $record->subscriber_name           = $request->input('subscriber_name');
        $record->trainer_name              = $request->input('trainer_name');
        $record->phone                     = $request->input('phone');
        $record->training_name             = $request->input('training_name');
        $record->train_time                = $request->input('train_time');
        $record->attendance                = $request->input('attendance');
        $record->save();
        return $record;
    }
}
