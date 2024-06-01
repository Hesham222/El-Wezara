<?php
namespace Organization\Actions\RoomLoss;
use Illuminate\Http\Request;
use Organization\Models\{
    RoomLoss
};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  RoomLoss::create([
            'room_id'       => $request->input('room'),
            'request_date'  => $request->input('request_date'),
            'customer'      => $request->input('customer'),
            'missingInfo'         => $request->input('notes'),
            'created_by' => auth('organization_admin')->user()->id,
        ]);
        return $record;
    }
}
