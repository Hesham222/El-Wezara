<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;

use Organization\Actions\PaymentReport\{
    FilterAction,
};
use Organization\Http\Requests\PaymentReport\{
    FilterDateRequest,
};
use Organization\Exports\PaymentReport\{
    ExportData,
};
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Customer;
use Organization\Models\Payment;
use Organization\Models\Subscription;
use Organization\Models\Training;


class PaymentReportController extends JsonResponse
{
    public function index()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Report-View-Payment')
        ){
            $subscribers    = Customer::has('Payments')->get();
            $payments       = Payment::get();
            $subscriptions  = Subscription::has('Payments')->get();
            $trainings      = Training::has('Subscriptions.Payments')->get();
            return view('Organization::paymentReports.index',compact('subscribers','payments','subscriptions','trainings'));
        }else
            return abort(401);
    }

    public function data(Request $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'          => $request->input('view'),
                'column'        => $request->input('column'),
                'value'         => $request->input('value'),
                'start_date'    => $request->input('start_date'),
                'end_date'      => $request->input('end_date'),
                'date_from'     => $request->input('date_from'),
                'date_to'       => $request->input('date_to'),
                'subscriber'    => $request->input('subscriber'),
                'phone'         => $request->input('phone'),
                'payment'       => $request->input('payment'),
                'subscription'  => $request->input('subscription'),
                'training'      => $request->input('training'),

            ]);
        $result = view('Organization::paymentReports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_payment_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
