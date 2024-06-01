<?php
namespace Organization\Actions\DailyAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    DailyAccount
};
use Organization\Models\JournalEntry;

class StoreAction
{
    public function execute(Request $request)
    {

        $record =  DailyAccount::create([

            'journal_entry_id'          => $request->input('journal_entry_id'),
        ]);
        JournalEntry::where('id',$record->journal_entry_id)->update([
            'status' =>1,
        ]);
        return $record;
    }
}
