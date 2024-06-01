<?php
namespace Organization\Actions\RentSpace;
use Illuminate\Http\Request;
use Organization\Models\{
    RentSpace
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = RentSpace::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
