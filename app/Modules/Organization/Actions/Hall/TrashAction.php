<?php
namespace Organization\Actions\Hall;
use Illuminate\Http\Request;
use Organization\Models\{
    Hall
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Hall::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
