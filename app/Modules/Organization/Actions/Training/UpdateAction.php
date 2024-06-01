<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\{
    Training
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                         = Training::find($id);
        $record->name                   = $request->input('name');
        $record->club_sport_id          = $request->input('club_sport_id');
        $record->activity_area_id       = $request->input('activity_area_id');
        $record->freelance_trainer_id   = $request->input('freelance_trainer_id');
        $record->type                   = $request->input('type');
        $record->save();
        return $record;
    }
}
