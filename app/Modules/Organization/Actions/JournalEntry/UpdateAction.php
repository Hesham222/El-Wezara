<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;
use Organization\Models\{
    JournalEntry
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $data = $request->all();
        $credit_amounts = $data['amount_credit'];
        $debit_amounts = $data['amount'];
        //dd($credit_amounts);

        $total_credit =  array_sum($credit_amounts);
        $total_debit  =  array_sum($debit_amounts);
        //dd($total_credit);
        $check = $total_credit == $total_debit;

        if($total_credit == $total_debit){
            $record                             = JournalEntry::find($id);
            $record->description                = $request->input('description');
            $record->sum_debits                 = $total_debit;
            $record->sum_credits                = $total_credit;
            $record->save();
            return $record;
        }else{
            false;
        }


    }
}
