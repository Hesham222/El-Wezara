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


class HrNotificationController extends JsonResponse
{
    use FileTrait;

    public function notifications()
    {
        $all_vacations = VacationRequest::count();
        $last_two_days_vacations = VacationRequest::where('created_at','>=',\carbon\Carbon::now()->subdays(2))->count();


         $all_financialAdvanceRequests = FinancialAdvanceRequest::count();
        $last_two_days_financialAdvanceRequests = FinancialAdvanceRequest::where('created_at','>=',\carbon\Carbon::now()->subdays(2))->count();
      
        return view('Organization::hrNotifications.index',compact('all_vacations','last_two_days_vacations',
    'all_financialAdvanceRequests','last_two_days_financialAdvanceRequests'  
  ));
    }

   


}