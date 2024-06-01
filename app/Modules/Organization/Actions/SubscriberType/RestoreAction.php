<?php
namespace Organization\Actions\SubscriberType;
use Illuminate\Http\Request;
use Organization\Models\{
    SubscribersType
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = SubscribersType::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
