<?php
namespace Organization\Actions\RoomType;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomType
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = RoomType::find($id);

        $record->name                       = $request->input('name');
        $record->num_of_persons             = $request->input('num_of_persons');
        $record->save();

        return $record;
    }
}
