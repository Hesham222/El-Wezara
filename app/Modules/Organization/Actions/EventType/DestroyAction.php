<?php
namespace Organization\Actions\EventType;
use Illuminate\Http\Request;

use Organization\Models\{EventType, SubscribersType};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = EventType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
