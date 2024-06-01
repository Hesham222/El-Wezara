<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\IngredientTotal\{
    IngredientTotalFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\IngredientTotal\{
    IngredientTotalExportData,
};

use App\Http\Traits\FileTrait;
use Organization\Models\IngredientCategory;

class IngredientTotalController extends JsonResponse
{
    use FileTrait;

    public function IngredientTotalIndex()
    {
        $categories = IngredientCategory::get();
        return view('Organization::IngredientTotal.IngredientTotal_index',compact('categories'));
    }

    public function IngredientTotalData(FilterDateRequest $request, IngredientTotalFilterAction $filterAction)
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
        $result = view('Organization::IngredientTotal.components.IngredientTotal_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function IngredientTotalExport(FilterDateRequest $request, IngredientTotalFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new IngredientTotalExportData($records), 'IngredientTotal_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }


}
