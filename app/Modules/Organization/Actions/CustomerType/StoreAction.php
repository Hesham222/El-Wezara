<?php
namespace Organization\Actions\CustomerType;
use Illuminate\Http\Request;
use Organization\Models\{
    CustomerType
};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  CustomerType::create([
            'name'                      => $request->input('name'),
        ]);

        return $record;
    }
}
