<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;

use Organization\Actions\DailyCenter\{
    FilterAction,
};

use Organization\Exports\DailyCenter\{
    ExportData,
};
use Organization\Models\Account;
use Organization\Models\DailyAccount;


class DailyCenterController extends JsonResponse
{

    public function index(Request $request)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDailyCenter-View')
        ){
            $accounts = Account::all();
            $dailyAccounts = DailyAccount::whereHas('JournalEntry', function ($query){
                $query->where('status',1);
            })->get();
            $start_date = null;
            $end_date = null ;
            if($request->has('start_date')){

                $start_date = $request->input('start_date');
                $end_date = $request->input('end_date');

            }
            return view('Organization::dailyCenters.index',compact('accounts','dailyAccounts','start_date','end_date'));
        }else
            return abort(401);
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
                'date_from'  => $request->input('date_from'),
                'date_to'    => $request->input('date_to'),
            ]);

        $result = view('Organization::dailyCenters.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

//    public function export(FilterDateRequest $request, FilterAction $filterAction)
//    {
//        try{
//            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
//            return Excel::download(new ExportData($records), 'organization_payments_data.csv');
//        }
//        catch (\Exception $ex){
//            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
//        }
//    }

}
