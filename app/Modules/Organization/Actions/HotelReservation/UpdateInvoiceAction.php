<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\HotelInnvoiceExtra;
use Organization\Models\{
    HotelReservation
};
use Organization\Models\HotelReservationInnvoice;

class UpdateInvoiceAction
{
    public function execute(Request $request,$id)
    {
        $record = HotelReservationInnvoice::findorfail($id);
        $extraPersonPrice = $record->hotelReservation->Room->ParentRoom->extra_price;
        $extraKidPrice = $record->hotelReservation->Room->ParentRoom->child_price;
        $totalExtraPrice =  ($extraPersonPrice * $request->input('extraPerson')) + ($extraKidPrice * $request->input('extraKid'));
        $record->hotelReservation->total_price_for_duration = $record->hotelReservation->total_price_for_duration + $totalExtraPrice;
        $record->hotelReservation->final_price = $record->hotelReservation->final_price + $totalExtraPrice;
        $record->hotelReservation->invoicesAmount = $record->hotelReservation->invoicesAmount + $totalExtraPrice;
        $record->hotelReservation->remainingAmount = $record->hotelReservation->remainingAmount + $totalExtraPrice;
        $record->hotelReservation->save();

        HotelInnvoiceExtra::create([
            'hotel_reservation_innvoice_id' => $record->id,
            'extraPerson' => $request->input('extraPerson'),
            'extraPersonPrice'  => $extraPersonPrice * $request->input('extraPerson'),
            'extraChild'    => $request->input('extraKid'),
            'extraChildPrice'   => $extraKidPrice * $request->input('extraKid')
        ]);

        $record->amount = $record->amount + $totalExtraPrice;
        $record->status = "Admin Confirmed";
        $record->save();

        return $record;
    }
}
