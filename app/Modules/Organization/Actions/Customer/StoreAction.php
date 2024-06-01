<?php
namespace Organization\Actions\Customer;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Customer
};
use Organization\Models\CustomerData;

class StoreAction
{
    public function execute(Request $request)
    {
        $file = null;
        $record =  Customer::create([
            'name'                  => $request->input('name'),
            'customerType_id'       => $request->input('customerType_id'),
            'email'                 => $request->input('email'),
            'phone'                 => $request->input('phone'),
            'gender'                => $request->input('gender'),
            'address'               => $request->input('address'),
            'date_of_birth'         => $request->input('date_of_birth'),
            'nationality'           => $request->input('nationality'),
        ]);

        if(!is_null($request['attachment']))
        {
            $file               = FileTrait::storeMultiple($request->file('attachment'),'customers');
            foreach ($request['attachment'] as $key => $value) {

                if(!empty($value)){

                    $data = new CustomerData();
                    $data->customer_id          = $record->id;
                    $data->customerType_id      = $record->customerType_id ;
                    $data->attachment           = $file[$key];
                    if(isset($request['text'][$key])){
                        $data->text                 = $request['text'][$key];
                    }
                    $data->save();
                }
            }
        }else{
            if (!is_null($request['text']))
            {
                foreach ($request['text'] as $key => $value) {

                    if(!empty($value)){

                        $data = new CustomerData();
                        $data->customer_id          = $record->id;
                        $data->customerType_id      = $record->customerType_id ;
                        $data->text                 = $value;
                        if(isset($request['attachment'][$key])){
                            $data->attachment           = $file[$key];
                        }
                        $data->save();
                    }
                }
            }
        }
       // dd($record);

        return $record;
    }
}
