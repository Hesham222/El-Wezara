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
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;

class AreasNotificationController extends JsonResponse
{
    use FileTrait;

    public function notifications()
    {
        $all_preparationAreaOrders = PreparationAreaOrder::count();
        $last_two_days_preparationAreaOrders = PreparationAreaOrder::where('created_at','>=',\carbon\Carbon::now()->subdays(2))->count();


         $all_pos_orders = PointOfSaleOrder::count();
        $last_two_days_pos_orders = PointOfSaleOrder::where('created_at','>=',\carbon\Carbon::now()->subdays(2))->count();
      
        return view('Organization::areasNotifications.index',compact('all_preparationAreaOrders','last_two_days_preparationAreaOrders',
    'all_pos_orders','last_two_days_pos_orders'  
  ));
    }

   


}