<?php
namespace Organization\Actions\Room;
use Illuminate\Http\Request;
use Organization\Models\{
    Rooms
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = Rooms::find($id);
        $record->status                       = $request->input('roomStatus');
        $record->save();
        return $record;
    }
}
