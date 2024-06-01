<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;
use Organization\Models\{
    JournalEntry
};
use Organization\Models\DebitSection;

class DebitStoreAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();
        $credit_amounts = $data['amount_credit'];
        $debit_amounts = $data['amount'];
        //dd($credit_amounts);

        $total_credit =  array_sum($credit_amounts);
        $total_debit  =  array_sum($debit_amounts);
        //dd($total_debit);

        foreach ($data['amount'] as $key => $value) {

            if(!empty($value)){
                if($total_credit == $total_debit) {
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
                        $debit->subAccount_id       =$after_;
                        $debit->save();
                    }


                }
            }
        }
    }
}
