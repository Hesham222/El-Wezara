<?php
namespace Organization\Actions\LaundryService;
use Illuminate\Http\Request;
use Organization\Models\{
    LService
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = LService::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
