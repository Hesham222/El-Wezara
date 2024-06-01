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

use Organization\Models\FinancialAdvanceRequest;
use Organization\Models\HotelOrder;
use Organization\Models\LaundryOrder;
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;

class LaundryNotificationController extends JsonResponse
{
    use FileTrait;

    public function notifications()
    {
        $all_laundryOrders = LaundryOrder::count();
        $last_two_days_laundryOrders = LaundryOrder::where('created_at','>=',\carbon\Carbon::now()->subdays(2))->count();

      
        return view('Organization::laundriesNotifications.index',compact('all_laundryOrders','last_two_days_laundryOrders'));
    }

   


}