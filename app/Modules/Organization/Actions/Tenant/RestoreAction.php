<?php
namespace Organization\Actions\Tenant;;
use Illuminate\Http\Request;
use Organization\Models\{
    Tenant
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Tenant::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
