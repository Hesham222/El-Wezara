<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\CategoryTotal\{
    CategoryTotalFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\CategoryTotal\{
    CategoryTotalExportData,
};

use App\Http\Traits\FileTrait;
use Organization\Models\IngredientCategory;

class CategoryTotalController extends JsonResponse
{
    use FileTrait;

    public function CategoryTotalIndex()
    {
        $categories = IngredientCategory::get();
        return view('Organization::CategoryTotal.CategoryTotal_index',compact('categories'));
    }

    public function CategoryTotalData(FilterDateRequest $request, CategoryTotalFilterAction $filterAction)
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
        $result = view('Organization::CategoryTotal.components.CategoryTotal_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function CategoryTotalExport(FilterDateRequest $request, CategoryTotalFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new CategoryTotalExportData($records), 'CategoryTotal_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }


}
