<?php
namespace Organization\Actions\Reservation;
use Illuminate\Http\Request;
use Organization\Models\{EventHall,
    EventType,
    Package,
    PackageItem,
    PackageSupplierService,
    Reservation,
    ReservationPayment,
    ReservationSupplierService,
    SubscribersType};
class addPaymentAction
{
    public function execute(Request $request)
    {
        $reservation = Reservation::find($request->input('reservation_id'));
        $remaining_amount =  $reservation->remaining_amount - $request->input('paid_amount');
        $record =  ReservationPayment::create([
            'reservation_id'  =>  $request->input('reservation_id'),
            'paid_amount'  =>  $request->input('paid_amount'),
            'remaining_amount' => $remaining_amount,
            'method'       =>  $request->input('method'),
        ]);
        $reservation->remaining_amount = $remaining_amount;
        $reservation->paid_amount += $request->input('paid_amount');
        $reservation->save();
        return $record;
    }

}
