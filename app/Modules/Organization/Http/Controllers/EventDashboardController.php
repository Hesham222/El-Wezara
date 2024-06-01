<?php

namespace Organization\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\ExternalReservation;
use Organization\Models\Reservation;

class EventDashboardController extends JsonResponse
{
    public function eventDashboard()
    {
        //get weekly reservations count
       $this_week_reservations =  Reservation::where('status', '!=' ,'cancelled')->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SATURDAY), Carbon::now()->endOfWeek(Carbon::FRIDAY)])->count();
        //get weekly events count

       $start_week_carbon =  Carbon::now()->startOfWeek(Carbon::SATURDAY);
       $end_week_carbon =  Carbon::now()->endOfWeek(Carbon::FRIDAY);

       $start_week  = $start_week_carbon->format('Y-m-d');
       $end_week    = $end_week_carbon->format('Y-m-d');

       $this_week_events =  Reservation::where('status', '!=' ,'cancelled')->whereBetween('booking_date', [$start_week, $end_week])->count();

        // get actual amount this month

       $this_month_actual =  Reservation::where('status', '!=' ,'cancelled')->whereMonth('created_at',  Carbon::now()->month )->sum('actual_price');
       // get paid amount this month

       $this_month_paid =  Reservation::where('status', '!=' ,'cancelled')->whereMonth('created_at',  Carbon::now()->month )->sum('paid_amount');

        /// get remaining amount this month

       $this_month_remaining =  Reservation::where('status', '!=' ,'cancelled')->whereMonth('created_at',  Carbon::now()->month )->sum('remaining_amount');

        /// get supplier amount this month

        $this_month_supplier_remaining =  Reservation::where('status', '!=' ,'cancelled')->whereMonth('created_at',  Carbon::now()->month )->sum('supplier_remaining_amount');
        $statistics = array(
            'weeklyReservations'        => $this_week_reservations,
            'weeklyEvents'              => $this_week_events,
            'monthlyActual'             => $this_month_actual,
            'monthlyPaid'               => $this_month_paid,
            'monthlyRemaining'          => $this_month_remaining,
            'supplier_remaining_amount' => $this_month_supplier_remaining,


        );


        $reservations =  Reservation::where('status', '!=' ,'cancelled')->get();

        $events = array();
        foreach ($reservations as $reservation){
            $from = $reservation->from;
            $to = $reservation->to;
            $start_time = date('H:i', strtotime($from));
            $end_time = date('H:i', strtotime($to));

            //return Carbon::createFromFormat('Y-m-d H:i', $reservation->date.$reservation->start_time, 'Africa/Cairo');
            $events[] = [
                'title'=>$reservation->CustomerType?$reservation->CustomerType->name:"لا يوجد",
                'start'=>Carbon::createFromFormat('Y-m-d H:i', $reservation->booking_date.$start_time),
                'end'  =>Carbon::createFromFormat('Y-m-d H:i', $reservation->booking_date.$end_time),
                'id'   =>$reservation->id,
            ];
        }
        return view('Organization::events',compact('statistics','events'));

    }
    public function showReservation(Request $request){
        $booking = Reservation::find($request->event_id);

        return response()->json($booking);

    }
}
