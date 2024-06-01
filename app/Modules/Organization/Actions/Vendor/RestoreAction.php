<?php
namespace Organization\Actions\Vendor;;
use Illuminate\Http\Request;
use Organization\Models\{
    Vendor
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Vendor::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
