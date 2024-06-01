<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\AreaConsumption\{
    AreaConsumptionFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\AreaConsumption\{
    AreaConsumptionExportData,
};
use App\Http\Traits\FileTrait;

class AreaConsumptionController extends JsonResponse
{
    use FileTrait;

    public function AreaConsumptionIndex()
    {
        return view('Organization::AreaConsumption.AreaConsumption_index');
    }

    public function AreaConsumptionData(FilterDateRequest $request, AreaConsumptionFilterAction $filterAction)
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
        $result = view('Organization::AreaConsumption.components.AreaConsumption_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function AreaConsumptionExport(FilterDateRequest $request, AreaConsumptionFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new AreaConsumptionExportData($records), 'AreaConsumption_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
