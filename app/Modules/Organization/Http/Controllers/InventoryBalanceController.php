<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\InventoryBalance\{
    InventoryBalanceFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\InventoryBalance\{
    InventoryBalanceExportData,
};

use App\Http\Traits\FileTrait;
use Organization\Models\IngredientCategory;

class InventoryBalanceController extends JsonResponse
{
    use FileTrait;

    public function InventoryBalanceIndex()
    {
        return view('Organization::InventoryBalance.InventoryBalance_index');
    }

    public function InventoryBalanceData(FilterDateRequest $request, InventoryBalanceFilterAction $filterAction)
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
        $result = view('Organization::InventoryBalance.components.InventoryBalance_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function InventoryBalanceExport(FilterDateRequest $request, InventoryBalanceFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new InventoryBalanceExportData($records), 'InventoryBalance_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }


}
