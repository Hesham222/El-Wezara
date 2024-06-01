<?php
namespace Organization\Actions\LaundryOrder;
use Illuminate\Http\Request;
use Organization\Models\{EventHall,
    EventType,
    HotelReservation,
    HotelReservationInnvoice,
    LaundryOrder,
    LaundryOrderPayment,
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
        $order = LaundryOrder::find($request->input('order_id'));
        $record =  LaundryOrderPayment::create([
            'laundry_order_id'              =>  $request->input('order_id'),
            'paid_amount'                   => $request->input('paid_amount'),
            'total_remaining_amount'        => $request->input('total_remaining_amount'),
            'remaining_amount'              => $request->input('remaining_amount'),
            'method'                        => $request->input('method'),
            'date'                          => $request->input('date'),
            'time'                          => $request->input('time'),
        ]);
        $order->remaining_amount = $request->input('remaining_amount');
        $order->paid_amount += $request->input('paid_amount');
        $order->save();


//        $reservation_invoce = new HotelReservationInnvoice();
//        $reservation_invoce->hotel_reservation_id = $request->input('hotelReservation_id');
//        $reservation_invoce->model_type = "RoomDamage";
//        $reservation_invoce->model_id = $record->id;
//        $reservation_invoce->amount = $record->amount;
//        $reservation_invoce->save();
//
//        $emp_reserve = HotelReservation::FindOrFail($request->input('hotelReservation_id'));
//        // update hotel reservation
//        $emp_reserve->invoicesAmount += $record->amount ;
//        $emp_reserve->save();
//        $emp_reserve->remainingAmount = $emp_reserve->invoicesAmount - $emp_reserve->paidAmount;
//        $emp_reserve->save();

        return $record;
    }

}

