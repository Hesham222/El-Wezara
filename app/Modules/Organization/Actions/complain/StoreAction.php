<?php
namespace Organization\Actions\complain;
use Illuminate\Http\Request;
use Organization\Models\{CustomerComplain, CustomerType};
class StoreAction
{
    public function execute(Request $request)
    {

        $record =  CustomerComplain::create([
            'complain'                      => $request->input('complain'),
            'customer_id'                      => $request->input('customer'),
            'created_by'                      => auth('organization_admin')->user()->id,
        ]);

        return $record;
    }
}
