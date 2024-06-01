<?php
namespace Organization\Actions\ExternalPayment;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalPayment
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = ExternalPayment::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
