<?php
namespace Organization\Actions\Hotel;
use Illuminate\Http\Request;
use Organization\Models\{
    Hotel
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Hotel::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
