<?php
namespace Organization\Actions\JournalEntry;
use Illuminate\Http\Request;
use Organization\Models\{
    JournalEntry,
    JournalEntryInvoice
};
class StoreAction
{
    public function execute(Request $request)
    {
        $data = $request->all();
        $credit_amounts = $data['amount_credit'];
        $debit_amounts = $data['amount'];
        //dd($credit_amounts);

        $total_credit =  array_sum($credit_amounts);
        $total_debit  =  array_sum($debit_amounts);
        //dd($total_credit);
        $check = $total_credit == $total_debit;
        //dd($check);
        if($total_credit == $total_debit){
            $record =  JournalEntry::create([
                'description'                   => $request->input('description'),
                'sum_debits'                    => $total_debit,
                'sum_credits'                   => $total_credit,
                'created_by'                    => auth('organization_admin')->user()->id,

            ]);


            if ($request->has('invoicesIds')) {

$ids = [];
//return dd()
foreach (explode(',', $request->input('invoicesIds')[0]) as $info) {
    # code...
array_push($ids, $info);
}
                    foreach ( $ids as $id ) {

                    $new = new JournalEntryInvoice();
                    $new->journal_entry_id = $record->id;
                    $new->model_type = $request->modelType;
                    $new->model_id = $id;
                    $new->save();
                    }

            }

            return $record;
        }else{
            return false;
        }


    }
}
