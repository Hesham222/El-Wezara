<?php
namespace Organization\Actions\LaundryService;;
use Illuminate\Http\Request;

use Organization\Models\{
    LService
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = LService::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
