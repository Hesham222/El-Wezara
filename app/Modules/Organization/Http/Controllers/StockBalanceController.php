<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\IngredientCategory;
use Organization\Actions\StockBalance\{
    StockBalanceFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\StockBalance\{
    StockBalanceExportData,
};

use App\Http\Traits\FileTrait;

class StockBalanceController extends JsonResponse
{
    use FileTrait;

    public function StockBalanceIndex()
    {
        return view('Organization::StockBalance.StockBalance_index');
    }

    public function StockBalanceData(FilterDateRequest $request, StockBalanceFilterAction $filterAction)
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
        $result = view('Organization::StockBalance.components.StockBalance_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function StockBalanceExport(FilterDateRequest $request, StockBalanceFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new StockBalanceExportData($records), 'StockBalance_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }


}
