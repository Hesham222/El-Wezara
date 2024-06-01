<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PoConsumptionDetail\{
    PoConsumptionDetailFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\PoConsumptionDetail\{
    PoConsumptionDetailExportData,
};
use App\Http\Traits\FileTrait;
use Organization\Models\PreparationAreaStocking;

class PoConsumptionDetailController extends JsonResponse
{
    use FileTrait;

    public function PoConsumptionDetailIndex($id)
    {
        $record = PreparationAreaStocking::FindOrFail($id);

        return view('Organization::PoConsumptionDetail.PoConsumptionDetail_index',compact('record'));
    }

    public function PoConsumptionDetailData(FilterDateRequest $request, PoConsumptionDetailFilterAction $filterAction,$id)
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
        $result = view('Organization::PoConsumptionDetail.components.PoConsumptionDetail_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function PoConsumptionDetailExport(FilterDateRequest $request, PoConsumptionDetailFilterAction $filterAction,$id)
    {
        try{
            $records = $filterAction->execute($request,$id)->orderBy('id','DESC')->get();
            return Excel::download(new PoConsumptionDetailExportData($records), 'PointOfSaleConsumptionDetail_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
