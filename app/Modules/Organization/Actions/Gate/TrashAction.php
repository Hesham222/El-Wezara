<?php
namespace Organization\Actions\Gate;
use Illuminate\Http\Request;
use Organization\Models\{
    Gate
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Gate::find($request->resource_id);
//        if(!$record)
//            return false;
//        $record->deleted_by = auth('organization_admin')->user()->id;
//        $record->save();
        $record->forceDelete();
        return $record->id;
    }
}
