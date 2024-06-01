<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\HotelConsumptionDetail\{
    HotelConsumptionDetailFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\HotelConsumptionDetail\{
    HotelConsumptionDetailExportData,
};
use App\Http\Traits\FileTrait;
use Organization\Models\HotelStoking;

class HotelConsumptionDetailController extends JsonResponse
{
    use FileTrait;

    public function HotelConsumptionDetailIndex($id)
    {
        $hotel= HotelStoking::FindOrFail($id);
        return view('Organization::HotelConsumptionDetail.HotelConsumptionDetail_index',compact('hotel'));
    }

    public function HotelConsumptionDetailData(FilterDateRequest $request, HotelConsumptionDetailFilterAction $filterAction,$id)
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
        $result = view('Organization::HotelConsumptionDetail.components.HotelConsumptionDetail_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function HotelConsumptionDetailExport(FilterDateRequest $request, HotelConsumptionDetailFilterAction $filterAction,$id)
    {
        try{
            $records = $filterAction->execute($request,$id)->orderBy('id','DESC')->get();
            return Excel::download(new HotelConsumptionDetailExportData($records), 'HotelConsumptionDetail_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
