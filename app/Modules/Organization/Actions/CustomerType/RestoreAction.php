<?php
namespace Organization\Actions\CustomerType;
use Illuminate\Http\Request;
use Organization\Models\{
    CustomerType
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = CustomerType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
