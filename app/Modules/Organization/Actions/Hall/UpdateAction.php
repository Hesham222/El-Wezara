<?php
namespace Organization\Actions\Hall;
use Illuminate\Http\Request;
use Organization\Models\{
    Hall
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = Hall::find($id);
        $record->name           = $request->input('name');
        $record->minimum           = $request->input('minimum');
        $record->maximum           = $request->input('maximum');
        $record->description    = $request->input('description');
        $record->save();
        return $record;
    }
}
