<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;

use Organization\Actions\RevenueSport\{
    FilterAction,
};
use Organization\Http\Requests\RevenueReport\{
    FilterDateRequest,
};

use Organization\Exports\RevenueSport\{
    ExportData,
};
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Payment;
use Organization\Models\Subscription;
use Organization\Models\Training;


class RevenueSportController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Report-View-RevenueSport')
        ){
            return view('Organization::revenueSports.index');

        }else
            return abort(401);
    }

    public function show($id)
    {
        //total subscriptions amount
         $training    = Training::where('club_sport_id',$id)->first();
         $subscriptionAmounts    = Subscription::where('training_id',$training->id)->sum('price');

        // Total Paid Subscription Amount
        $subscriptions    = Subscription::where('training_id',$id)->get();
        $total = array();
        foreach ($subscriptions as $subscription){

            $total[]              = Payment::where('subscription_id',$subscription->id)->sum('payment_amount');
        }
        $totalPaid = array_sum($total);

        //Total Remaining Subscription Amount
        $totalRemaining         = Subscription::where('training_id',$id)->sum('payment_balance');

        return view('Organization::revenueSports.show', compact('subscriptionAmounts','totalPaid','totalRemaining'));
    }
    public function trainingDetails($id)
    {

        $records    = Training::where('club_sport_id',$id)->get();

        return view('Organization::revenueSports.trainingDetails', compact('records'));
    }

    public function subscriptionDetails($id)
    {
        $records    = Subscription::where('training_id',$id)->get();

        return view('Organization::revenueSports.subscriptionDetails', compact('records'));
    }

    public function data(Request $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),
                'date_from'     => $request->input('date_from'),
                'date_to'       => $request->input('date_to'),
                ]);
        $result = view('Organization::revenueSports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_revenue_sport_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
