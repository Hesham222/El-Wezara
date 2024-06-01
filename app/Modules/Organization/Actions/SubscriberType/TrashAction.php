<?php
namespace Organization\Actions\SubscriberType;
use Illuminate\Http\Request;
use Organization\Models\{
    SubscribersType
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = SubscribersType::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
