<?php
namespace Organization\Actions\ClubSport;
use Illuminate\Http\Request;
use Organization\Models\{
    ClubSport
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = ClubSport::find($id);
        $record->name           = $request->input('name');
        $record->description    = $request->input('description');
        $record->save();
        return $record;
    }
}
