<?php

namespace Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Report\FilterAction;
use Organization\Http\Requests\Report\{FilterDateRequest};
use Organization\Actions\Report\FilterAction_customers;
use Organization\Actions\Report\FilterAction_expected_revenues;
use Organization\Actions\Report\FilterAction_net_revenues;
use Organization\Actions\Report\FilterAction_revenues;
use Organization\Actions\Report\FilterAction_transactions;
use Organization\Actions\Report\FilterAction_triple;
use Organization\Exports\Report\ExportData;
use Organization\Exports\Report\ExportData_customers;
use Organization\Exports\Report\ExportData_expected_revenues;
use Organization\Exports\Report\ExportData_net_revenues;
use Organization\Exports\Report\ExportData_revenues;
use Organization\Exports\Report\ExportData_transactions;
use Organization\Exports\Report\ExportData_triple;
use Organization\Models\Reservation;

class ReportController extends JsonResponse
{
    public function reservations()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Reservations')
        ){
            return view('Organization::reports.reservations');
        }else
            return abort(401);
    }

    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_report_reservations_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }



    public function customers()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Customers')
        ){
            return view('Organization::reports.customers');
        }else
            return abort(401);
    }

    public function data_customers(FilterDateRequest $request, FilterAction_customers $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.customers.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export_customers(FilterDateRequest $request, FilterAction_customers $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData_customers($records), 'organization_report_customers_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }



    public function transactions()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Transactions')
        ){
            return view('Organization::reports.transactions');
        }else
            return abort(401);
    }

    public function data_transactions(FilterDateRequest $request, FilterAction_transactions $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.transactions.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export_transactions(FilterDateRequest $request, FilterAction_transactions $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData_transactions($records), 'organization_report_transactions_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }



    public function revenue()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Revenue')
        ){
            return view('Organization::reports.revenue');
        }else
            return abort(401);
    }

    public function data_revenue(FilterDateRequest $request, FilterAction_revenues $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.revenues.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export_revenue(FilterDateRequest $request, FilterAction_revenues $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData_revenues($records), 'organization_report_revenues_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function expected_revenue()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Expected-Revenue')
        ){
            return view('Organization::reports.expected_revenue');
        }else
            return abort(401);
    }

    public function data_expected_revenue(FilterDateRequest $request, FilterAction_expected_revenues $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.expected_revenues.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export_expected_revenue(FilterDateRequest $request, FilterAction_expected_revenues $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData_expected_revenues($records), 'organization_report_revenues_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function net_revenue()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Net-Revenue')
        ){
            return view('Organization::reports.revenue');
        }else
            return abort(401);
    }

    public function data_net_revenue(FilterDateRequest $request, FilterAction_net_revenues $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.revenues.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export_net_revenue(FilterDateRequest $request, FilterAction_net_revenues $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData_net_revenues($records), 'organization_report_revenues_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }



    public function triple()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'ReportReservation-Triple')
        ){
            return view('Organization::reports.triple');
        }else
            return abort(401);
    }

    public function data_triple(FilterDateRequest $request, FilterAction_triple $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::reports.components.triple.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export_triple(FilterDateRequest $request, FilterAction_triple $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData_triple($records), 'organization_report_triple_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function triple_services($id){
        $reservation = Reservation::find($id);
        $res_services = $reservation->reservationExtraServices;
        $res_package_services = $reservation->package->packageSupplierServices;
        $records = $res_package_services->merge($res_services);
        return view('Organization::reports.triple_services',compact('records'));
    }

}
