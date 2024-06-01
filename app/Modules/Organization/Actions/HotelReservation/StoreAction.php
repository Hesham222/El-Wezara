<?php
namespace Organization\Actions\HotelReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\{
    HotelReservation
};
use Organization\Models\HotelReservationInnvoice;
use Organization\Models\Rooms;

class StoreAction
{
    public function execute(Request $request)
    {
        //dd($request->input());
        if(empty($request->input('final_price'))){
            $finalPrice = $request->input('total_price_for_duration');
            $record                             =  HotelReservation::create([
                'customer_id'                   => $request->input('customer_id'),
                'hotel_id'                      => $request->input('hotel'),
                'roomType_id'                   => $request->input('roomType_id'),
                'arrival_date'                  => $request->input('arrival_date'),
                'departure_date'                => $request->input('departure_date'),
                'num_of_nights'                 => $request->input('num_of_nights'),
                'room_id'                       => $request->input('room_id'),
                'price_per_night'               => $request->input('price_per_night'),
                'total_price_for_duration'      => $request->input('total_price_for_duration'),
                'num_of_children'               => $request->input('num_of_children'),
                'num_of_extra_beds'             => $request->input('num_of_extra_beds'),
                'final_price'                   => $request->input('total_price_for_duration'),
                'invoicesAmount'                => $request->input('total_price_for_duration'),
                'remainingAmount'               => $request->input('total_price_for_duration'),
                'supplier_id'                   => $request->input('supplier'),
            ]);
        }else{
            $finalPrice = $request->input('final_price');
            $record                             =  HotelReservation::create([
                'customer_id'                   => $request->input('customer_id'),
                'hotel_id'                      => $request->input('hotel'),
                'roomType_id'                   => $request->input('roomType_id'),
                'arrival_date'                  => $request->input('arrival_date'),
                'departure_date'                => $request->input('departure_date'),
                'num_of_nights'                 => $request->input('num_of_nights'),
                'room_id'                       => $request->input('room_id'),
                'price_per_night'               => $request->input('price_per_night'),
                'total_price_for_duration'      => $request->input('total_price_for_duration'),
                'num_of_children'               => $request->input('num_of_children'),
                'num_of_extra_beds'             => $request->input('num_of_extra_beds'),
                'final_price'                   => $request->input('final_price'),
                'invoicesAmount'                => $request->input('final_price'),
                'remainingAmount'               => $request->input('final_price'),
                'supplier_id'                   => $request->input('supplier'),
            ]);
        }

        Rooms::where('id',$record->room_id)->update([
            'status' => 'UnAvailable',
        ]);
        for ($i = 1 ; $i<= $request->input('num_of_nights'); $i++)
        {
            $newDate = Carbon::createFromFormat('Y-m-d', $request->input('arrival_date'));
            if ($i > 1)
                $newDate = $newDate->addDays($i-1);

            HotelReservationInnvoice::create([
                'hotel_reservation_id' => $record->id,
                'model_type'    => "HotelReservation",
                'model_id'      => $record->id,
                'amount'    => $request->input('price_per_night'),
                'invoice_date'  => $newDate,
            ]);
        }
        //dd($record);

        return $record;
    }
    public function isAreaTaken($request)
    {
        $arrival_date     = $request['arrival_date'];
        $departure_date   = $request['departure_date'];
        $rentContracts  = HotelReservation::where(['hotel_id'=> $request->input('hotel') ,'room_id'=> $request->input('room_id')])->get();
        //dd($rentContracts) ;
        if (
            $rentContracts->where('arrival_date', '>=', $arrival_date)->where('arrival_date', '<', $departure_date)->count() ||
            $rentContracts->where('arrival_date', '<', $arrival_date)->where('departure_date', '>', $arrival_date)->count() ||
            $rentContracts->where('arrival_date', '<', $departure_date)->where('departure_date', '>', $departure_date)->count()||
            $rentContracts->where('arrival_date', '<', $arrival_date)->where('departure_date', '>', $departure_date)->count()
        )
        {
            return true;
        }
        else{
            return false;
        }
    }
}
