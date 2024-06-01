<?php
namespace Organization\Actions\Hall;;
use Illuminate\Http\Request;

use Organization\Models\{
    Hall
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Hall::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
