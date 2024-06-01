<?php
namespace Organization\Actions\ExternalReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\{
    ExternalReservation
};

class StoreAction
{
    public function execute(Request $request)
    {
        if ($request->input('total')){

            $record =  ExternalReservation::create([
                'subscriber_id'         => $request->input('subscriber_id'),
                'external_pricing_id'   => $request->input('external_pricing_id'),
                'num_of_hours'          => $request->input('num_of_hours'),
                'date'                  => $request->input('date'),
                'start_time'            => $request->input('start_time'),
                'end_time'              => $request->input('end_time'),
                'total'                 => $request->input('total'),
            ]);
            return $record;

        }else{
            return  false;
        }
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
