<?php
namespace Organization\Actions\SubscriberType;
use Illuminate\Http\Request;
use Organization\Models\{
    SubscribersType
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  SubscribersType::create([
            'type'          => $request->input('type'),
            'description'   => $request->input('description'),
        ]);
        return $record;
    }
}
