<?php
namespace Organization\Actions\VendorType;
use Illuminate\Http\Request;
use Organization\Models\{CustomerType, VendorType};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = VendorType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
