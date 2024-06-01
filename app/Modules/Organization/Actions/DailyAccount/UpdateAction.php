<?php
namespace Organization\Actions\DailyAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    DailyAccount
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                            = DailyAccount::find($id);

        $record->journal_entry_id          = $request->input('journal_entry_id');

        $record->save();
        return $record;
    }
}
