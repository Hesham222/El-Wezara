<?php
namespace Organization\Actions\Vendor;
use App\Helpers\UploadFile;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{CustomerData, Vendor, VendorData};


class StoreAction
{
    public function execute(Request $request): void
    {

        //upload  tax_card_attachment file
//        if ($request->file('tax_card_attachment'))
//            $tax_card_attachment =  UploadFile::UploadSinglelFile($request->file('tax_card_attachment'),'vendors_tax_card_attachments');
//        else
//            $tax_card_attachment = null;

        if ($request->file('tax_card_attachment')){
//            $tax_card_attachment = $request->file('tax_card_attachment')->store('vendors_tax_card_attachments');
            $tax_card_attachment = FileTrait::storeSingleFile($request->file('tax_card_attachment'),'vendors_tax_card_attachments');

        }else{
            $tax_card_attachment = null;
        }


        //upload  commercial_record_attachment file
//        if ($request->file('commercial_record_attachment'))
//            $commercial_record_attachment=  UploadFile::UploadSinglelFile($request->file('commercial_record_attachment'),'vendors_commercial_record_attachment');
//        else
//            $commercial_record_attachment = null;


        if ($request->file('commercial_record_attachment')){
//            $commercial_record_attachment = $request->file('commercial_record_attachment')->store('vendors_commercial_record_attachment');
            $commercial_record_attachment = FileTrait::storeSingleFile($request->file('commercial_record_attachment'),'vendors_commercial_record_attachment');

        }else{
            $commercial_record_attachment = null;
        }

        $record =  Vendor::create([

                'name' => $request->input('name'),
                'company_name' => $request->input('company_name'),
            'vendorType_id'       => $request->input('vendorType_id'),
                'tax_card' => $request->input('tax_card'),
                'commercial_record' => $request->input('commercial_record'),
            'tax_card_attachment' => $tax_card_attachment,
            'commercial_record_attachment' => $commercial_record_attachment,
        ]);



        if(isset($request['attachment']) && !is_null($request['attachment']))
        {
            $file               = FileTrait::storeMultiple($request->file('attachment'),'vendors');
            foreach ($request['attachment'] as $key => $value) {

                if(!empty($value)){

                    $data = new VendorData();
                    $data->vendor_id          = $record->id;
                    $data->vendorType_id      = $record->vendorType_id ;
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

                        $data = new VendorData();
                        $data->vendor_id          = $record->id;
                        $data->vendorType_id      = $record->vendorType_id ;
                        $data->text                 = $value;
                        if(isset($request['attachment'][$key])){
                            $data->attachment           = $file[$key];
                        }
                        $data->save();
                    }
                }
            }
        }

    }
}
