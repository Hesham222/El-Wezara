<?php
namespace Organization\Actions\RentContractPayment;

use Illuminate\Http\Request;
use Organization\Models\{
    RentContractPayment
};

class PayAction
{
    public function execute(Request $request)
    {
        $record = RentContractPayment::find($request->resource_id);
        if(!$record)
            return false;
        $record->status = 1;
        $record->paidBy = $request->payment_type;
        $record->save();
        return $request->resource_id;
    }
}
