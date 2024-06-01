<?php
namespace Organization\Actions\ExternalReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalReservation
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                             = ExternalReservation::find($id);

        $record->subscriber_id              = $request->input('subscriber_id');
        $record->external_pricing_id        = $request->input('external_pricing_id');
        $record->num_of_hours               = $request->input('num_of_hours');
        $record->date                       = $request->input('date');
        $record->start_time                 = $request->input('start_time');
        $record->end_time                   = $request->input('end_time');
        $record->total                      = $request->input('total');

        $record->save();
        return $record;
    }

    public function isAreaTaken($request)
    {
        $start_time     = $request['start_time'];
        $end_time       = $request['end_time'];
        $rentContracts  = ExternalReservation::where(['external_pricing_id'=> $request['external_pricing_id'] ,'date'=> $request->input('date')])->get();
        if (
            $rentContracts->where('start_time', '>=', $start_time)->where('start_time', '<', $end_time)->count() ||
            $rentContracts->where('start_time', '<', $start_time)->where('end_time', '>', $start_time)->count() ||
            $rentContracts->where('start_time', '<', $end_time)->where('end_time', '>', $end_time)->count()||
            $rentContracts->where('start_time', '<', $start_time)->where('end_time', '>', $end_time)->count()
        )
        {
            return true;
        }
        else{
            return false;
        }
    }
}
