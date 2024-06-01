<?php
namespace Organization\Actions\Account;
use Illuminate\Http\Request;
use Organization\Models\{
    Account
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  Account::create([
            'name'                  => $request->input('name'),
            'account_type_id'       => $request->input('account_type_id'),
            'account_number'        => $request->input('account_number'),
        ]);
        return $record;
    }
}
