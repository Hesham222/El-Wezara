<?php
namespace Organization\Actions\CustomerType;
use Illuminate\Http\Request;
use Organization\Models\{
    CustomerInformation
};
class InformationStoreAction
{
    public function execute(Request $request,$record)
    {
        $data = $request->all();

        foreach ($data['title'] as $key => $value) {

            if(!empty($value)){

                $schedule = new CustomerInformation();
                $schedule->customerType_id      = $record->id;
                $schedule->title                = $value;
                $schedule->document_type        = $data['document_type'][$key];
                $schedule->status               = $data['status'][$key];
                $schedule->save();
            }
        }
    }
}
