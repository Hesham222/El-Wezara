<?php
namespace Organization\Actions\SubAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAccount
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  SubAccount::create([
            'name'                  => $request->input('name'),
            'account_id'            => $request->input('account_id'),
        ]);
        return $record;
    }
}
