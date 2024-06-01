<?php
namespace Organization\Actions\Vendor;
use App\Helpers\UploadFile;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Vendor
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {






            $record        = Vendor::find($id);
        $record->fill([
            'name' => $request->input('name'),
            'company_name' => $request->input('company_name'),

            'tax_card' => $request->input('tax_card'),
            'commercial_record' => $request->input('commercial_record'),

        ]);

        if ($request->file('commercial_record_attachment')) {
            UploadFile::RemoveFile($record->commercial_record_attachment);
            $commercial_record_attachment = FileTrait::storeSingleFile($request->file('commercial_record_attachment'),'vendors_commercial_record_attachment');
            $record->commercial_record_attachment = $commercial_record_attachment;
        }

        if ($request->file('tax_card_attachment')){
            UploadFile::RemoveFile($record->tax_card_attachment);
            $tax_card_attachment = FileTrait::storeSingleFile($request->file('tax_card_attachment'),'vendors_tax_card_attachments');
            $record->tax_card_attachment = $tax_card_attachment;

        }

        $record->save();
    }
}
