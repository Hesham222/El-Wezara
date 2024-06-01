<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\MinMaxIngredient\{
    MinMaxIngredientFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\MinMaxIngredient\{
    MinMaxIngredientExportData,
};

use App\Http\Traits\FileTrait;
use Organization\Models\IngredientCategory;

class MinMaxIngredientController extends JsonResponse
{
    use FileTrait;

    public function MinMaxIngredientIndex()
    {
        $categories = IngredientCategory::get();
        return view('Organization::MinMaxIngredient.MinMaxIngredient_index',compact('categories'));
    }

    public function MinMaxIngredientData(FilterDateRequest $request, MinMaxIngredientFilterAction $filterAction)
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
        $result = view('Organization::MinMaxIngredient.components.MinMaxIngredient_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function MinMaxIngredientExport(FilterDateRequest $request, MinMaxIngredientFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new MinMaxIngredientExportData($records), 'MinMaxIngredient_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
