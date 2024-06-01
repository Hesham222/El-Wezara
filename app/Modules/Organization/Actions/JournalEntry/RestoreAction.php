<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;
use Organization\Models\{
    JournalEntry
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = JournalEntry::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
