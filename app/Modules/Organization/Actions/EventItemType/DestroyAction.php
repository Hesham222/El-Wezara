<?php
namespace Organization\Actions\EventItemType;;
use Illuminate\Http\Request;

use Organization\Models\{
    EventItemType
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = EventItemType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
