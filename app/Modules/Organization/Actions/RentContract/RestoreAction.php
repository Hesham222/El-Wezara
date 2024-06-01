<?php
namespace Organization\Actions\RentContract;
use Illuminate\Http\Request;
use Organization\Models\{
    RentContract
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = RentContract::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
