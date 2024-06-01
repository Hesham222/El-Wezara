<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;

use Organization\Models\{
    Training
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Training::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
