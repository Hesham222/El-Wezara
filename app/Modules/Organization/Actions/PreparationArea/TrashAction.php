<?php
namespace Organization\Actions\PreparationArea;
use Illuminate\Http\Request;
use Organization\Models\{LService, PreparationArea};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = PreparationArea::find($request->resource_id);
        if(!$record)
            return false;
//        $record->deleted_by = auth('organization_admin')->user()->id;
//        $record->save();
        $record->delete();
        return $record->id;
    }
}
