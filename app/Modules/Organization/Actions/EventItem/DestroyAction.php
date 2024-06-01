<?php
namespace Organization\Actions\EventItem;;
use Illuminate\Http\Request;

use Organization\Models\{
    EventItem
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = EventItem::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
