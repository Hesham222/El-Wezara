<?php

namespace Organization\Http\Controllers;

use Organization\Models\Account;
use Illuminate\Http\Request;

class BalanceSheetController extends JsonResponse
{

    
    public function index(Request $request)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialBalanceSheet-View')
        ){
            $accounts = Account::all();
            /*$result = [];
            $totalDebit = $account->Debits->sum('amount');
            $totalCredit = $account->Credits->sum('amount');
            if($totalCredit > $totalDebit)
            {
                $result[0] = "Debit";
                $result[1] = $totalCredit - $totalDebit;
            }
            elseif ($totalDebit > $totalCredit)
            {
                $result[0] = "Credit";
                $result[1] = $totalDebit - $totalCredit;
            }*/
            $start_date = null;
            $end_date = null ;
            if($request->has('start_date')){

                $start_date = $request->input('start_date');
                $end_date = $request->input('end_date');

            }
            return view('Organization::balanceSheets.index',compact('accounts','start_date','end_date'));
        }else
            return abort(401);
    }
}
