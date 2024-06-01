<?php

namespace Organization\Http\Controllers;

use Organization\Models\Account;

class IncomeStatementController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialIncomeStatement-View')
        ){
            //$accounts = Account::has('SubAccounts')->get();
            $incomeAccounts = Account::where('account_type_id',3)->get();
            $expenseAccounts = Account::where('account_type_id',2)->get();
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

            return view('Organization::incomeStatements.index',compact('incomeAccounts','expenseAccounts'));
        }else
            return abort(401);
    }
}
