<?php
namespace Organization\Actions\SportArea;
use Illuminate\Http\Request;
use Organization\Models\{
    SportActivityAreas
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = SportActivityAreas::find($id);
        $record->name           = $request->input('name');
        $record->description    = $request->input('description');
        $record->save();
        return $record;
    }
}
