<?php
namespace Organization\Actions\FreelanceTrainer;
use Illuminate\Http\Request;
use Organization\Models\{
    FreelanceTrainer
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = FreelanceTrainer::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
