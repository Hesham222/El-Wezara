<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;
use Organization\Models\{
    JournalEntry
};
use Organization\Models\DebitSection;

class DebitUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        DebitSection::where('journal_entry_id',$record->id)->delete();

        foreach ($data['amount'] as $key => $value) {
            $info  = $request['account_id'][$key];
            $after_ = substr($info, strpos($info, "-") + 1);
            $before_ = strtok($info,'-');
            //dd($before_);
            if($before_  == 1){

                //return($before_);

                $debit = new DebitSection();
                $debit->journal_entry_id       = $record->id;
                $debit->amount              = $value;
                $debit->account_id          = $after_;
                $debit->save();

            }else{
                $debit = new DebitSection();
                $debit->journal_entry_id       = $record->id;
                $debit->amount              = $value;
                $debit->subAccount_id       = $after_;
                $debit->save();
            }


        }
    }
}
