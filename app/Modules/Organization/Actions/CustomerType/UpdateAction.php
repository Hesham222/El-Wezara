<?php
namespace Organization\Actions\CustomerType;
use Illuminate\Http\Request;
use Organization\Models\{
    CustomerType
};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = CustomerType::find($id);

        $record->name                       = $request->input('name');
        $record->save();

        return $record;
    }
}
