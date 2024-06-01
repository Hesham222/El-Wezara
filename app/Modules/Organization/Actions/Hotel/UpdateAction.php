<?php
namespace Organization\Actions\Hotel;
use Illuminate\Http\Request;
use Organization\Models\{
    Hotel
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = Hotel::find($id);

        $record->name                       = $request->input('name');
        $record->manager_id                 = $request->input('manager_id');
        $record->save();

        return $record;
    }
}
