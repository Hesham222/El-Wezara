<?php
namespace Organization\Actions\VendorType;
use Illuminate\Http\Request;
use Organization\Models\{CustomerType, VendorType};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  VendorType::create([
            'name'                      => $request->input('name'),
        ]);

        return $record;
    }
}
