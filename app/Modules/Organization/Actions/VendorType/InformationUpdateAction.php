<?php
namespace Organization\Actions\VendorType;
use Illuminate\Http\Request;
use Organization\Models\{CustomerInformation, VendorInformation};
class InformationUpdateAction
{
    public function execute(Request $request,$record)
    {

        $data = $request->all();

        VendorInformation::where('vendorType_id',$record->id)->delete();

        for ($i=0;$i<count($data['title']);$i++) {

            $schedule = new VendorInformation();
            $schedule->vendorType_id      = $record->id;
            $schedule->title                = $request->title[$i];
            $schedule->document_type        = $request->document_type[$i];
            $schedule->status               = $request->status[$i];
            $schedule->save();
        }
    }
}
