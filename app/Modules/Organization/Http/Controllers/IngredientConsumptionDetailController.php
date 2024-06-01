<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\IngredientConsumptionDetail\{
    IngredientConsumptionDetailFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\IngredientConsumptionDetail\{
    IngredientConsumptionDetailExportData,
};
use App\Http\Traits\FileTrait;
use Organization\Models\PreparationAreaStocking;

class IngredientConsumptionDetailController extends JsonResponse
{
    use FileTrait;

    public function IngredientConsumptionDetailIndex($id)
    {
        $record = PreparationAreaStocking::FindOrFail($id);

        return view('Organization::IngredientConsumptionDetail.IngredientConsumptionDetail_index',compact('record'));
    }

    public function IngredientConsumptionDetailData(FilterDateRequest $request, IngredientConsumptionDetailFilterAction $filterAction,$id)
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
        $result = view('Organization::IngredientConsumptionDetail.components.IngredientConsumptionDetail_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function IngredientConsumptionDetailExport(FilterDateRequest $request, IngredientConsumptionDetailFilterAction $filterAction,$id)
    {
        try{
            $records = $filterAction->execute($request,$id)->orderBy('id','DESC')->get();
            return Excel::download(new IngredientConsumptionDetailExportData($records), 'IngredientConsumptionDetail_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
