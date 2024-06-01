<?php
namespace Organization\Actions\VendorType;
use Illuminate\Http\Request;
use Organization\Models\{CustomerType, VendorType};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = VendorType::find($id);

        $record->name                       = $request->input('name');
        $record->save();

        return $record;
    }
}
