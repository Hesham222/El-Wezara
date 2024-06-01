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
class addMoneyBackAction
{
    public function execute(Request $request)
    {
        $reservation                = Reservation::find($request->input('reservation_id'));
        $paid_amount                =  $reservation->paid_amount - $request->input('money_back');
        $reservation->paid_amount   = $paid_amount;
        $reservation->money_back    = $request->input('money_back');
        $reservation->save();
        return true;
    }

}
