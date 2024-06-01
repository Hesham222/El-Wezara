<?php
namespace Organization\Actions\Account;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Account
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = Account::find($id);


        $record->name                    = $request->input('name');
        $record->account_type_id         = $request->input('account_type_id');
        $record->account_number          = $request->input('account_number');
        $record->save();
        return $record;
    }
}
