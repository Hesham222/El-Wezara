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
    ReservationSupplier,
    ReservationSupplierPayment,
    ReservationSupplierService,
    SubscribersType};
class addSupplierPaymentAction
{
    public function execute(Request $request)
    {
        $object = ReservationSupplier::where('vendor_id',$request->input('supplier'))->where('reservation_id',$request->input('reservation_id'))->first();
        $reservation = Reservation::find($request->input('reservation_id'));
        $remaining_amount =  $object->remaining_amount - $request->input('paid_amount');
        $record =  ReservationSupplierPayment::create([
            'reservation_id'            =>  $request->input('reservation_id'),
            'vendor_id'               => $request->input('supplier'),
            'paid_amount'               =>  $request->input('paid_amount'),
            'supplier_remaining_amount' => $remaining_amount,
            'method'                    =>  $request->input('method'),
        ]);
        $reservation->supplier_remaining_amount -= $request->input('paid_amount');
        $reservation->save();
        $object->paid_amount += $request->input('paid_amount');
        $object->remaining_amount -= $request->input('paid_amount');
        $object->save();
        return $record;
    }

}
