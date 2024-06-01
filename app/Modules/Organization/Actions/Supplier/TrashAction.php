<?php
namespace Organization\Actions\Supplier;
use Illuminate\Http\Request;
use Organization\Models\{SportActivityAreas, Supplier};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Supplier::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
