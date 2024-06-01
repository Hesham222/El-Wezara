<?php
namespace Organization\Actions\EventItem;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItem
};

class StoreAction
{
    public function execute(Request $request)
    {
        $record =  EventItem::create([
            'name'                  =>  $request->input('name'),
            'event_item_type_id'    =>  $request->input('eventItemType'),
            'price'                 =>  $request->input('price'),
            'description'           =>  $request->input('description'),
            'created_by'            =>  auth('organization_admin')->user()->id
        ]);
        return $record;
    }
}
