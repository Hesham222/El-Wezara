<?php
namespace Organization\Actions\EventType;
use Illuminate\Http\Request;
use Organization\Models\{EventHall, EventType, SubscribersType};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = EventType::find($id);
        $record->name           = $request->input('name');
        $record->save();
        if ($request->input('halls'))
        {
            $record->eventHalls()->delete();
            foreach ($request->input('halls') as $hall)
            {
                EventHall::create([
                    'event_type_id' => $record->id,
                    'hall_id' => $hall
                ]);
            }
        }

        return $record;
    }
}
