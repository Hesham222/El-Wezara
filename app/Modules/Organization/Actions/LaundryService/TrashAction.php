<?php
namespace Organization\Actions\LaundryService;
use Illuminate\Http\Request;
use Organization\Models\{
    LService
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = LService::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
