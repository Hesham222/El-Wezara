<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPricing
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = ExternalPricing::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
