<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPricing
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = ExternalPricing::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
