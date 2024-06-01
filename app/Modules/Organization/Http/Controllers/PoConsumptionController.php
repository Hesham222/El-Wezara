<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PoConsumption\{
    PoConsumptionFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\PoConsumption\{
    PoConsumptionExportData,
};
use App\Http\Traits\FileTrait;

class PoConsumptionController extends JsonResponse
{
    use FileTrait;

    public function PoConsumptionIndex()
    {
        return view('Organization::PoConsumption.PoConsumption_index');
    }

    public function PoConsumptionData(FilterDateRequest $request, PoConsumptionFilterAction $filterAction)
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
        $result = view('Organization::PoConsumption.components.PoConsumption_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function PoConsumptionExport(FilterDateRequest $request, PoConsumptionFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PoConsumptionExportData($records), 'PoConsumption_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
