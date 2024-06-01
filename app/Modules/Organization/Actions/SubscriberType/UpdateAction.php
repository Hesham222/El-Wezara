<?php
namespace Organization\Actions\SubscriberType;
use Illuminate\Http\Request;
use Organization\Models\{
    SubscribersType
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = SubscribersType::find($id);
        $record->type           = $request->input('type');
        $record->description    = $request->input('description');
        $record->save();
        return $record;
    }
}
