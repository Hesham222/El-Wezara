<?php
namespace Organization\Actions\complain;
use Illuminate\Http\Request;
use Organization\Models\{CustomerComplain, CustomerType};

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = CustomerComplain::find($id);
        $record->complain                      = $request->input('complain');
         //   $record->customer                      = $request->input('customer');
            $record->created_by                      = auth('organization_admin')->user()->id;

        $record->save();

        return $record;
    }
}
