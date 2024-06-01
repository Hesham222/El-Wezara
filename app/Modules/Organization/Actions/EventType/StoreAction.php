<?php
namespace Organization\Actions\EventType;
use Illuminate\Http\Request;
use Organization\Models\{EventHall, EventType, SubscribersType};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  EventType::create([
            'name'          => $request->input('name'),
        ]);

        foreach ($request->input('halls') as $hall)
        {
            EventHall::create([
                'event_type_id' => $record->id,
                'hall_id' => $hall
            ]);
        }

        return $record;
    }

}
