<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\IngredientConsumption\{
    IngredientConsumptionFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\IngredientConsumption\{
    IngredientConsumptionExportData,
};
use App\Http\Traits\FileTrait;

class IngredientConsumptionController extends JsonResponse
{
    use FileTrait;

    public function IngredientConsumptionIndex()
    {
        return view('Organization::IngredientConsumption.IngredientConsumption_index');
    }

    public function IngredientConsumptionData(FilterDateRequest $request, IngredientConsumptionFilterAction $filterAction)
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
        $result = view('Organization::IngredientConsumption.components.IngredientConsumption_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function IngredientConsumptionExport(FilterDateRequest $request, IngredientConsumptionFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new IngredientConsumptionExportData($records), 'IngredientConsumption_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
