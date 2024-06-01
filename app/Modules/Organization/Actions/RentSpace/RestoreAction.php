<?php
namespace Organization\Actions\RentSpace;;
use Illuminate\Http\Request;
use Organization\Models\{
    RentSpace
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = RentSpace::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
