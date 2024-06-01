<?php
namespace Organization\Actions\Subscriber;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscriber
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Subscriber::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
