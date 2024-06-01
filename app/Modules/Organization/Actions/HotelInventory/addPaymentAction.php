<?php
namespace Organization\Actions\LaundryOrder;
use Illuminate\Http\Request;
use Organization\Models\{EventHall,
    EventType,
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
        return $record;
    }

}

