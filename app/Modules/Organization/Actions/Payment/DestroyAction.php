<?php
namespace Organization\Actions\Payment;;
use Illuminate\Http\Request;

use Organization\Models\{
    Payment
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Payment::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
