<?php
namespace Organization\Actions\FreelanceTrainer;;
use Illuminate\Http\Request;

use Organization\Models\{
    FreelanceTrainer
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = FreelanceTrainer::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
