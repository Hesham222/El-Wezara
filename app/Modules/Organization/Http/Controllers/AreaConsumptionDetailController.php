<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\AreaConsumptionDetail\{
    AreaConsumptionDetailFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\AreaConsumptionDetail\{
    AreaConsumptionDetailExportData,
};
use App\Http\Traits\FileTrait;
use Organization\Models\PreparationAreaStocking;

class AreaConsumptionDetailController extends JsonResponse
{
    use FileTrait;

    public function AreaConsumptionDetailIndex($id)
    {
        $record = PreparationAreaStocking::FindOrFail($id);

        return view('Organization::AreaConsumptionDetail.AreaConsumptionDetail_index',compact('record'));
    }

    public function AreaConsumptionDetailData(FilterDateRequest $request, AreaConsumptionDetailFilterAction $filterAction,$id)
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
        $result = view('Organization::AreaConsumptionDetail.components.AreaConsumptionDetail_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function AreaConsumptionDetailExport(FilterDateRequest $request, AreaConsumptionDetailFilterAction $filterAction,$id)
    {
        try{
            $records = $filterAction->execute($request,$id)->orderBy('id','DESC')->get();
            return Excel::download(new AreaConsumptionDetailExportData($records), 'PreparationAreaConsumptionDetail_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
