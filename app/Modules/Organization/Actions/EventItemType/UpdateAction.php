<?php
namespace Organization\Actions\EventItemType;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItemType
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = EventItemType::find($id);
        $record->name       = $request->input('name');
        $record->save();
        return $record;
    }
}
