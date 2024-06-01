<?php
namespace Organization\Actions\Customer;
use Illuminate\Http\Request;
use Organization\Models\{
    Customer
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Customer::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
