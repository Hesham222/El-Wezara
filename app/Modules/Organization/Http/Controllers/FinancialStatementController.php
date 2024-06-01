<?php

namespace Organization\Http\Controllers;

use Organization\Models\Account;

class FinancialStatementController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialStatement-View')
        ){
            //$accounts = Account::has('SubAccounts')->get();
            $assetAccounts = Account::where('account_type_id',1)->get();
            $liabilityAccounts = Account::where('account_type_id',4)->get();
            $ownerShipAccounts = Account::where('account_type_id',5)->get();
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

            return view('Organization::financialStatements.index',compact('assetAccounts','liabilityAccounts','ownerShipAccounts'));
        }else
            return abort(401);
    }
}
