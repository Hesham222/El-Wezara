<?php
namespace Organization\Actions\SubAccount;
use Illuminate\Http\Request;
use Organization\Models\{
    SubAccount
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = SubAccount::find($id);


        $record->name               = $request->input('name');
        $record->account_id         = $request->input('account_id');
        $record->save();
        return $record;
    }
}
