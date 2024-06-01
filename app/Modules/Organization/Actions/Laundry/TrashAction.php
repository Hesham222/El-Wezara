<?php
namespace Organization\Actions\Laundry;
use Illuminate\Http\Request;
use Organization\Models\{
    laundry
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = laundry::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
