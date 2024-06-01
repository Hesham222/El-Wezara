<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\{
    Schedule
};
class ScheduleUpdateAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        Schedule::where('training_id',$record->id)->forceDelete();

            for ($i=0;$i<count($data['day']);$i++) {

                $schedule = new Schedule();
                $schedule->training_id  = $record->id;
                $schedule->day          = $request->day[$i];
                $schedule->start_time   = $request->start_time[$i];
                $schedule->end_time     = $request->end_time[$i];
                $schedule->save();
            }
    }
}
