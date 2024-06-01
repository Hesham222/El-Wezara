<?php
namespace Organization\Actions\ExternalPricing;
use Illuminate\Http\Request;

use Organization\Models\{
    ExternalPricing
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = ExternalPricing::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
