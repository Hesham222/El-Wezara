<?php

namespace Organization\Http\Controllers;


use Carbon\Carbon;
use Organization\Models\HotelReservation;
use Organization\Models\RoomMaintenanceRequest;
use Organization\Models\Rooms;

class HousingDashboardController extends JsonResponse
{
    public function __invoke()
    {
        // get number of occupied rooms
        $rooms_occupied = Rooms::where('status','Occupied')->count();

        // get number of visitor coming today
         $date_now  = Carbon::now()->format('Y-m-d');

         $number_of_visitors_today = HotelReservation::where('arrival_date',$date_now)->count();

        // get number of available rooms
        $rooms_Available = Rooms::where('status','Available')->count();

        // get number of maintaining room requests
        $maintaining_requests = RoomMaintenanceRequest::count();

        // get number of maintaining room done
        $maintaining_available = RoomMaintenanceRequest::where('status','Accept')->count();

        // get number of maintaining room not done
        $maintaining_unavailable = RoomMaintenanceRequest::where('status','!=','Accept')->count();
        //return $maintaining_available;


        $statistics = array(
            'rooms_occupied'            => $rooms_occupied,
            'visitors_today'            => $number_of_visitors_today,
            'rooms_available'           => $rooms_Available,
            'maintaining_requests'      => $maintaining_requests,
            'maintaining_available'     => $maintaining_available,
            'maintaining_unavailable'   => $maintaining_unavailable,


        );
        return view('Organization::housing',compact('statistics'));
    }
}
