<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\LaundryConsumption\{
    LaundryConsumptionFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\LaundryConsumption\{
    LaundryConsumptionExportData,
};
use App\Http\Traits\FileTrait;

class LaundryConsumptionController extends JsonResponse
{
    use FileTrait;

    public function LaundryConsumptionIndex()
    {
        return view('Organization::LaundryConsumption.LaundryConsumption_index');
    }

    public function LaundryConsumptionData(FilterDateRequest $request, LaundryConsumptionFilterAction $filterAction)
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
        $result = view('Organization::LaundryConsumption.components.LaundryConsumption_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function LaundryConsumptionExport(FilterDateRequest $request, LaundryConsumptionFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new LaundryConsumptionExportData($records), 'LaundryConsumption_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
