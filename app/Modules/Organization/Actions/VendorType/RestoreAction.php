<?php
namespace Organization\Actions\VendorType;
use Illuminate\Http\Request;
use Organization\Models\{CustomerType, VendorType};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = VendorType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
