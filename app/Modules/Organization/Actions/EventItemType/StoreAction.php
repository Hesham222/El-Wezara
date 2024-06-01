<?php
namespace Organization\Actions\EventItemType;
use Illuminate\Http\Request;
use Organization\Models\{
    EventItemType
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  EventItemType::create([
            'name'       => $request->input('name'),
        ]);
        return $record;
    }
}
