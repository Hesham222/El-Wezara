<?php
namespace Organization\Actions\CustomerType;
use Illuminate\Http\Request;
use Organization\Models\{
    CustomerInformation
};
class InformationUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        CustomerInformation::where('customerType_id',$record->id)->delete();

        for ($i=0;$i<count($data['title']);$i++) {

            $schedule = new CustomerInformation();
            $schedule->customerType_id      = $record->id;
            $schedule->title                = $request->title[$i];
            $schedule->document_type        = $request->document_type[$i];
            $schedule->status               = $request->status[$i];
            $schedule->save();
        }
    }
}
