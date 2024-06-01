<?php
namespace Organization\Actions\Subscriber;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscriber
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                     = Subscriber::find($id);

        $attachment = $record->attachment;
        if($request->file('attachment'))
        {
            FileTrait::RemoveSingleFile($attachment);
            $attachment = FileTrait::storeSingleFile($request->file('attachment'), 'Subscribers');
        }

        $record->name                       = $request->input('name');
        $record->subscriber_type_id         = $request->input('subscriber_type_id');
        $record->phone                      = $request->input('phone');
        $record->second_phone               = $request->input('second_phone');
        $record->attachment                 = $attachment;
        $record->national_id                = $request->input('national_id');
        $record->save();
        return $record;
    }
}
