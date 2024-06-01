<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Organization\Actions\SubscriberBalance\{
    FilterAction,
};
use Organization\Http\Requests\SubscriberBalanceReport\{
    FilterDateRequest,
};
use Organization\Exports\SubscriberBalance\{
    ExportData,
};
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Customer;
use Organization\Models\Subscription;


class SubscriberBalanceReportController extends JsonResponse
{
    public function index()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Report-View-SubscriberBalances')
        ){
            $records = Customer::whereHas('Subscriptions',function ($query){
                $query->where('cancelled', 0)->where('current_session','>',0)->orWhere('start_date','<=',Carbon::now())->orWhere('end_date','=>',Carbon::now());
            })->get();
            return view('Organization::subscriberBalances.index',compact('records'));
        }else
            return abort(401);
    }

    public function show($id)
    {
        $records = Subscription::where('subscriber_id', $id)->where('cancelled', 0)->where('current_session','>',0)->orWhere('start_date','<=',Carbon::now())->orWhere('end_date','=>',Carbon::now())->where('payment_balance', '>', 0)->get();
        return view('Organization::subscriberBalances.show', compact('records'));
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = Customer::get();
            return Excel::download(new ExportData($records), 'organization_subscriber_balance_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
