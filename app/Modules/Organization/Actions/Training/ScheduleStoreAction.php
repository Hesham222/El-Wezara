<?php
namespace Organization\Actions\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\Training;
use Organization\Models\{
    Schedule
};
class ScheduleStoreAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        foreach ($data['day'] as $key => $value) {

            if(!empty($value)) {
                $schedule = new Schedule();
                $schedule->training_id = $record->id;
                $schedule->day = $value;
                $schedule->start_time = $data['start_time'][$key];
                $schedule->end_time = $data['end_time'][$key];


                $start = strtotime($data['start_time'][$key]);
                $end = strtotime($data['end_time'][$key]);

                if ($end <= $start) {
                    return false;
                } else {
                    $schedule->save();

                }
            }

            return $schedule;
        }
    }
}
