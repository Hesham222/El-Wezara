<?php
namespace Organization\Actions\PointOfSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\Employee;
use Organization\Models\EmployeeOrder;
use Organization\Models\HotelReservation;
use Organization\Models\HotelReservationInnvoice;
use Organization\Models\Order;
use Organization\Models\OrderPayment;
use Organization\Models\PointOfSaleOrderSheet;
use Organization\Models\Rooms;


class CloseOrderAction
{
    public function execute(Request $request)
    {
        $record = Order::FindOrFail($request->order_id);

        if ($request->payment_type == "cash" || $request->payment_type == "visa" || $request->payment_type == "credit")
        {
            $tax = $record->total_amount * .12 ;
            $record->total_amount = $record->total_amount + $tax ;
            $record->status = "closed";
            $record->save();
            // add order payment type
            $order_payment = new OrderPayment();
            $order_payment->order_id = $record->id;
            $order_payment->type = $request->payment_type;
            $order_payment->amount = $record->total_amount;
            $order_payment->save();
        }
        elseif ($request->payment_type == "employee")
        {
                $emp = Employee::FindOrFail($request->employee);
            $record->status = "closed";
            $record->save();
            // add order to emp orders table
            $emp_order = new EmployeeOrder();
            $emp_order->employee_id = $emp->id;
            $emp_order->order_id = $record->id;
            $emp_order->save();

            // add order payment type
            $order_payment = new OrderPayment();
            $order_payment->order_id = $record->id;
            $order_payment->type = $request->payment_type;
            $order_payment->amount = $record->total_amount;
            $order_payment->save();

        }
        elseif ($request->payment_type == "hotel")
        {
                // check if emp  reserve this room
                $emp_reserve = HotelReservation::where('customer_id',$request->customer_id)
                    ->where('room_id',Rooms::where('room_num',$request->room_num)->first()->id)->first();
                if (!$emp_reserve){
                    return 0;
                }
                $record->status = "closed";
                $record->save();

                $reservation_invoce = new HotelReservationInnvoice();
                $reservation_invoce->hotel_reservation_id = $emp_reserve->id;
                $reservation_invoce->model_type = "Order";
                $reservation_invoce->model_id = $record->id;
                $reservation_invoce->amount = $record->total_amount;
                $reservation_invoce->save();

                // update hotel reservation
            $emp_reserve->invoicesAmount += $record->total_amount ;
            $emp_reserve->save();
            $emp_reserve->remainingAmount = $emp_reserve->invoicesAmount - $emp_reserve->paidAmount;
            $emp_reserve->save();


                // add order payment type
                $order_payment = new OrderPayment();
                $order_payment->order_id = $record->id;
                $order_payment->type = $request->payment_type;
                $order_payment->amount = $record->total_amount;
                $order_payment->save();

                //hotel reservation add amount
                $emp_reserve->invoicesAmount = $emp_reserve->invoicesAmount + $record->total_amount;
                $emp_reserve->save();
        }


        return $record->point_of_sale_id ;

    }



}
