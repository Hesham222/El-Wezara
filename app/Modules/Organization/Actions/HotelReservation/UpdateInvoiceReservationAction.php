<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    HotelReservationInnvoice
};

class UpdateInvoiceReservationAction
{
    public function execute(Request $request)
    {
        $record = HotelReservationInnvoice::findorfail($request->input('resource_id'));
        $record->hotelReservation->final_price = $record->hotelReservation->final_price - $record->amount;
        $record->hotelReservation->invoicesAmount = $record->hotelReservation->invoicesAmount - $record->amount;
        $record->hotelReservation->remainingAmount = $record->hotelReservation->remainingAmount - $record->amount;
        $record->hotelReservation->save();
        $record->hotel_reservation_id = $request->input('reservation_id');
        $record->save();

        $record->hotelReservation->final_price = $record->hotelReservation->final_price + $record->amount;
        $record->hotelReservation->invoicesAmount = $record->hotelReservation->invoicesAmount + $record->amount;
        $record->hotelReservation->remainingAmount = $record->hotelReservation->remainingAmount + $record->amount;

        return $record;
    }
}
