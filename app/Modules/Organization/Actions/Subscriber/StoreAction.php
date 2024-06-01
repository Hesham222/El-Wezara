<?php
namespace Organization\Actions\Subscriber;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    Subscriber
};
class StoreAction
{
    public function execute(Request $request)
    {
        $file = FileTrait::storeSingleFile($request->file('attachment'),'Subscribers');

        $record =  Subscriber::create([
            'name'                  => $request->input('name'),
            'subscriber_type_id'    => $request->input('subscriber_type_id'),
            'phone'                 => $request->input('phone'),
            'second_phone'          => $request->input('second_phone'),
            'attachment'            => $file,
            'national_id'           => $request->input('national_id'),
        ]);
        return $record;
    }
}
