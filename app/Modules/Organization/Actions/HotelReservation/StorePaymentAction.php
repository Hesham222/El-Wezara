<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    HotelReservationPayment
};

class StorePaymentAction
{
    public function execute(Request $request)
    {
        $record   =  HotelReservationPayment::create([
            'hotel_reservation_id'          => $request->input('reservation'),
            'amount'                        => $request->input('amount'),
            'method'                         => $request->input('method'),
        ]);
        $record->reservation->paidAmount = $record->reservation->paidAmount + $request->input('amount');
        $record->reservation->remainingAmount = $record->reservation->remainingAmount - $request->input('amount');
        $record->reservation->save();
        return $record;
    }
}
