<?php
namespace Organization\Actions\Package;
use Illuminate\Http\Request;
use Organization\Models\{EventType, Package, SubscribersType};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Package::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
