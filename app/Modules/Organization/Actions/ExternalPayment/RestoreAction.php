<?php
namespace Organization\Actions\ExternalPayment;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPayment
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = ExternalPayment::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
