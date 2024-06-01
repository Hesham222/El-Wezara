<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\{
    Training
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Training::create([
            'name'                  => $request->input('name'),
            'club_sport_id'         => $request->input('club_sport_id'),
            'activity_area_id'      => $request->input('activity_area_id'),
            'freelance_trainer_id'  => $request->input('freelance_trainer_id'),
            'type'                  => $request->input('type'),
        ]);
        return $record;
    }
}
