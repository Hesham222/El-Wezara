<?php
namespace Organization\Actions\ClubSport;
use Illuminate\Http\Request;
use Organization\Models\{
    ClubSport
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = ClubSport::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
