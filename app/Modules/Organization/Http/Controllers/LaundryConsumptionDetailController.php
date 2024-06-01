<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\LaundryConsumptionDetail\{
    LaundryConsumptionDetailFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\LaundryConsumptionDetail\{
    LaundryConsumptionDetailExportData,
};
use App\Http\Traits\FileTrait;
use Organization\Models\PreparationAreaStocking;

class LaundryConsumptionDetailController extends JsonResponse
{
    use FileTrait;

    public function LaundryConsumptionDetailIndex($id)
    {
        $record = PreparationAreaStocking::FindOrFail($id);

        return view('Organization::LaundryConsumptionDetail.LaundryConsumptionDetail_index',compact('record'));
    }

    public function LaundryConsumptionDetailData(FilterDateRequest $request, LaundryConsumptionDetailFilterAction $filterAction,$id)
    {
        $records = $filterAction->execute($request,$id)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::LaundryConsumptionDetail.components.LaundryConsumptionDetail_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function LaundryConsumptionDetailExport(FilterDateRequest $request, LaundryConsumptionDetailFilterAction $filterAction,$id)
    {
        try{
            $records = $filterAction->execute($request,$id)->orderBy('id','DESC')->get();
            return Excel::download(new LaundryConsumptionDetailExportData($records), 'LaundryConsumptionDetail_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
