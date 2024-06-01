<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;

use Organization\Models\{
    JournalEntry
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = JournalEntry::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
