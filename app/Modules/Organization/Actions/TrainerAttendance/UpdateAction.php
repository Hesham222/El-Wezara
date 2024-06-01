<?php
namespace Organization\Actions\TrainerAttendance;
use Illuminate\Http\Request;
use Organization\Models\{
    TrainerAttendance
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                            = TrainerAttendance::find($id);

        $record->trainer_name              = $request->input('trainer_name');
        $record->phone                     = $request->input('phone');
        $record->training_name             = $request->input('training_name');
        $record->train_time                = $request->input('train_time');
        $record->attendance                = $request->input('attendance');
        $record->save();
        return $record;
    }
}
