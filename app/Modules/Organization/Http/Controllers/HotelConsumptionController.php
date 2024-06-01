<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\HotelConsumption\{
    HotelConsumptionFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\HotelConsumption\{
    HotelConsumptionExportData,
};
use App\Http\Traits\FileTrait;

class HotelConsumptionController extends JsonResponse
{
    use FileTrait;

    public function HotelConsumptionIndex()
    {
        return view('Organization::HotelConsumption.HotelConsumption_index');
    }

    public function HotelConsumptionData(FilterDateRequest $request, HotelConsumptionFilterAction $filterAction)
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
        $result = view('Organization::HotelConsumption.components.HotelConsumption_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function HotelConsumptionExport(FilterDateRequest $request, HotelConsumptionFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new HotelConsumptionExportData($records), 'HotelConsumption_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
