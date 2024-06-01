<?php
namespace Organization\Actions\TrainerAttendance;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    TrainerAttendance
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  TrainerAttendance::create([

            'phone'                     => $request->input('phone'),
            'training_id'               => $request->input('training_id'),
            'train_time'                => $request->input('train_time'),
            'day'                       => $request->input('day'),
            'attendance'                => $request->input('attendance'),
        ]);
        return $record;
    }
}
