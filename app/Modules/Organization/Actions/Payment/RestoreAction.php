<?php
namespace Organization\Actions\Payment;
use Illuminate\Http\Request;
use Organization\Models\{
    Payment
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Payment::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
