<?php
namespace Admin\Actions\Organization;
use Illuminate\Http\Request;
use Admin\Models\{
    Organization
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Organization::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
