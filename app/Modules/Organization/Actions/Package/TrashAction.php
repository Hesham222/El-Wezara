<?php
namespace Organization\Actions\Package;
use Illuminate\Http\Request;
use Organization\Models\{EventType, Package, SubscribersType};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Package::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
