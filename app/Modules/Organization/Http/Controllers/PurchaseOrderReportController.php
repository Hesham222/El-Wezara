<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PurchaseOrderReport\{
    PurchaseOrderReportFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\PurchaseOrderReport\{
    PurchaseOrderReportExportData,
};

use App\Http\Traits\FileTrait;

class PurchaseOrderReportController extends JsonResponse
{
    use FileTrait;

    public function PurchaseOrderReportIndex()
    {
        return view('Organization::PurchaseOrderReport.PurchaseOrderReport_index');
    }

    public function PurchaseOrderReportData(FilterDateRequest $request, PurchaseOrderReportFilterAction $filterAction)
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
        $result = view('Organization::PurchaseOrderReport.components.PurchaseOrderReport_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function PurchaseOrderReportExport(FilterDateRequest $request, PurchaseOrderReportFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PurchaseOrderReportExportData($records), 'PurchaseOrderReport_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }


}
