<?php
namespace Organization\Actions\ClubSport;;
use Illuminate\Http\Request;

use Organization\Models\{
    ClubSport
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = ClubSport::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
