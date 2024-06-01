<?php
namespace Organization\Actions\RoomMaintenanceRequest;;
use Illuminate\Http\Request;

use Organization\Models\{
    RoomMaintenanceRequest
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = RoomMaintenanceRequest::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
