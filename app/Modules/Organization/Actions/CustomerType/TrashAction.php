<?php
namespace Organization\Actions\CustomerType;
use Illuminate\Http\Request;
use Organization\Models\{
    CustomerType
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = CustomerType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
