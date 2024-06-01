<?php
namespace Organization\Actions\Gate;;
use Illuminate\Http\Request;

use Organization\Models\{
    Gate
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Gate::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
