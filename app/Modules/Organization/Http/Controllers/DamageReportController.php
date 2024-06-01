<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\DamageReport\{
    DamageReportFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\DamageReport\{
    DamageReportExportData,
};

use App\Http\Traits\FileTrait;

class DamageReportController extends JsonResponse
{
    use FileTrait;

    public function DamageReportIndex()
    {
        return view('Organization::DamageReport.DamageReport_index');
    }

    public function DamageReportData(FilterDateRequest $request, DamageReportFilterAction $filterAction)
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
        $result = view('Organization::DamageReport.components.DamageReport_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function DamageReportExport(FilterDateRequest $request, DamageReportFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new DamageReportExportData($records), 'DamageReport_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }


}
