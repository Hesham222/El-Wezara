<?php

namespace Organization\Http\Controllers;
use Admin\Models\Admin;
use Illuminate\Support\Facades\DB;
use Organization\Actions\EmployeeFinancialReport\{
    FilterAction};
use Organization\Http\Requests\EmployeeFinancialReport\{
    FilterDateRequest
};
use Organization\Exports\EmployeeFinancialReport\{
    ExportData,
};
use Organization\Models\{Employee};

class EmployeeFinancialReportController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'EmployeeDeduction-View')
        ){
            return view('Organization::employeeFinancialReports.index');

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
        $result = view('Organization::employeeFinancialReports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




}
