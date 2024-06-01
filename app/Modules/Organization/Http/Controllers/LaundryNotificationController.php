<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\prepAreaNotification\{
    PrepAreaNotificationAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};

use App\Http\Traits\FileTrait;
use Organization\Models\Notification;
use Organization\Models\PreparationArea;
use Organization\Models\VacationRequest;

use Organization\Models\LaundryOrder;


class LaundryNotificationController extends JsonResponse
{
    use FileTrait;

    public function notifications()
    {
        $all_LaundryOrders = LaundryOrder::count();
        $last_two_days_LaundryOrders = LaundryOrder::where('created_at','>=',\carbon\Carbon::now()->subdays(2))->count();

      
        return view('Organization::laundryNotifications.index',compact('all_LaundryOrders','last_two_days_LaundryOrders',
  
  ));
    }

   


}