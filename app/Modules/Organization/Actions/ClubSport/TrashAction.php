<?php
namespace Organization\Actions\ClubSport;
use Illuminate\Http\Request;
use Organization\Models\{
    ClubSport
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = ClubSport::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
