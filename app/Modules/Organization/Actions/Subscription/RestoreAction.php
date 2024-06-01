<?php
namespace Organization\Actions\Subscription;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscription
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Subscription::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
