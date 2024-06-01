<?php
namespace Organization\Actions\Customer;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Customer
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = Customer::find($id);

        $attachment = $record->attachment;


        $record->name                   = $request->input('name');
        $record->customerType_id        = $request->input('customerType_id');
        $record->email                  = $request->input('email');
        $record->phone                  = $request->input('phone');
        $record->gender                 = $request->input('gender');
        $record->address                = $request->input('address');
        $record->date_of_birth          = $request->input('date_of_birth');
        $record->nationality            = $request->input('nationality');
        $record->save();

        foreach ($record->CustomerData as $key => $data) {
            //dd($request->file());

             $attach  = $request->file('attachment');
                //dd($attach);
            $file = array();
            if(isset($attach)){
                $file[]               = FileTrait::storeMultiple($attach,'customers');
            }
            $req_text = $request->input('text');
            $text = null;
            if(isset($req_text)){
                $text                         = $req_text[$key];
            }
                $data->customer_id            = $record->id;
                $data->customerType_id        = $record->customerType_id ;
                $data->text                   = $text?$text:$data->text;
                if(isset($file[0][$key])){
                    $data->attachment         = $file[0]?$file[0][$key]:$data->attachment;
                }
                $data->save();

        }
        return $record;
    }
}
