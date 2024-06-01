<?php
namespace Organization\Actions\EventItem;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItem
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                         = EventItem::find($id);
        $record->name                   = $request->input('name');
        $record->event_item_type_id     = $request->input('eventItemType');
        $record->price                  = $request->input('price');
        $record->description            = $request->input('description');
        $record->save();
        return $record;
    }
}
