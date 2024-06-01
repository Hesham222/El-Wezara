<?php
namespace Organization\Actions\RentContractPayment;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Organization\Models\RentContractPayment;

class FilterAction
{
    public function execute(Request $request)
    {
        return RentContractPayment::where('rent_contract_id',$request->route('id'))->select(['id','payment_date','rent_contract_id', 'amount','status','paidBy','updated_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('payment_date',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
            });
        });
    }
}
