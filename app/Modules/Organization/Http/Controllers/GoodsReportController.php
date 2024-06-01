<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\GoodsReport\{
    GoodsReportFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\GoodsReport\{
    GoodsReportExportData,
};

use App\Http\Traits\FileTrait;
use Organization\Models\IngredientCategory;

class GoodsReportController extends JsonResponse
{
    use FileTrait;

    public function GoodsReportIndex()
    {
        $categories = IngredientCategory::get();
        return view('Organization::GoodsReport.GoodsReport_index',compact('categories'));
    }

    public function GoodsReportData(FilterDateRequest $request, GoodsReportFilterAction $filterAction)
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
        $result = view('Organization::GoodsReport.components.GoodsReport_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function GoodsReportExport(FilterDateRequest $request, GoodsReportFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new GoodsReportExportData($records), 'GoodsReport_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }


}
