<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\CompanyDetail\{
    CompanyDetailFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\CompanyDetail\{
    CompanyDetailExportData,
};
use App\Http\Traits\FileTrait;
use Organization\Models\HotelStoking;
use Organization\Models\Supplier;

class CompanyDetailController extends JsonResponse
{
    use FileTrait;

    public function CompanyDetailIndex($id)
    {
        $supplier= Supplier::FindOrFail($id);
        return view('Organization::CompanyDetail.CompanyDetail_index',compact('supplier'));
    }

    public function CompanyDetailData(FilterDateRequest $request, CompanyDetailFilterAction $filterAction,$id)
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
        $result = view('Organization::CompanyDetail.components.CompanyDetail_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function CompanyDetailExport(FilterDateRequest $request, CompanyDetailFilterAction $filterAction,$id)
    {
        try{
            $records = $filterAction->execute($request,$id)->orderBy('id','DESC')->get();
            return Excel::download(new CompanyDetailExportData($records), 'CompanyDetail_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
