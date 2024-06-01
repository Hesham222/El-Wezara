<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\IngredientComponent\{
    IngredientComponentFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\IngredientComponent\{
    IngredientComponentExportData,
};

use App\Http\Traits\FileTrait;

class IngredientComponentController extends JsonResponse
{
    use FileTrait;

    public function IngredientComponentIndex()
    {
        return view('Organization::IngredientComponent.IngredientComponent_index');
    }

    public function IngredientComponentData(FilterDateRequest $request, IngredientComponentFilterAction $filterAction)
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
        $result = view('Organization::IngredientComponent.components.IngredientComponent_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function IngredientComponentExport(FilterDateRequest $request, IngredientComponentFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new IngredientComponentExportData($records), 'IngredientComponent_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }


}
