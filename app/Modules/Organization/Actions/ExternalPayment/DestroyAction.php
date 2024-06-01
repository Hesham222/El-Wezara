<?php
namespace Organization\Actions\ExternalPayment;;
use Illuminate\Http\Request;

use Organization\Models\{
    ExternalPayment
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = ExternalPayment::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
