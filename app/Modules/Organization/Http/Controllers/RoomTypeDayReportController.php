<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Organization\Actions\RoomTypeDayReport\{
    FilterAction,
};
use Organization\Http\Requests\RevenueReport\{
    FilterDateRequest,
};

use Organization\Exports\RoomTypeDayReport\{
    ExportData,
};
use Maatwebsite\Excel\Facades\Excel;

class RoomTypeDayReportController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Report-View-RoomTypeDayReport')
        ){
            return view('Organization::RoomTypeDayReports.index');

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
                'date'       => $request->input('date'),
                ]);
        $result = view('Organization::RoomTypeDayReports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_Room_Type_Report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
