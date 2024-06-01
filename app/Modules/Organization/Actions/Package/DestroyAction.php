<?php
namespace Organization\Actions\Package;
use Illuminate\Http\Request;

use Organization\Models\{EventType, Package, SubscribersType};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Package::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
