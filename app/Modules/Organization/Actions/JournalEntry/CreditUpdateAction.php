<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;
use Organization\Models\{
    JournalEntry
};
use Organization\Models\CreditSection;

class CreditUpdateAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        CreditSection::where('journal_entry_id',$record->id)->delete();

        foreach ($data['amount_credit'] as $key => $value) {
                $info  = $request['account'][$key];
                $after_ = substr($info, strpos($info, "-") + 1);
                $before_ = strtok($info,'-');

                if($before_  == 1){

                    //return($before_);

                    $debit = new CreditSection();
                    $debit->journal_entry_id       = $record->id;
                    $debit->amount                 = $value;
                    $debit->account_id                = $after_;
                    $debit->save();

                }else{
                    $debit = new CreditSection();
                    $debit->journal_entry_id       = $record->id;
                    $debit->amount                = $value;
                    $debit->subAccount_id            = $after_;
                    $debit->save();
                }


            }
    }
}
