<?php
namespace Organization\Actions\Subscriber;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscriber
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Subscriber::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
