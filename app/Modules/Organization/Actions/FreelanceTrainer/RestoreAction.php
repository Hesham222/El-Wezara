<?php
namespace Organization\Actions\FreelanceTrainer;
use Illuminate\Http\Request;
use Organization\Models\{
    FreelanceTrainer
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = FreelanceTrainer::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
