<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\resevedIngredentSupplier\{
    FilterAction,
};
use Organization\Http\Requests\PointOfSaleShiftSheet\{
    FilterDateRequest
};
use Organization\Exports\resevedIngredentSupplier\{
    ExportData,
};




use App\Http\Traits\FileTrait;





class ResevedIngredentSupplierController extends JsonResponse
{
    use FileTrait;
    
    public function index()
    {
        return view('Organization::resevedIngredentSuppliers.index');
    }



    public function data(FilterDateRequest $request, FilterAction $filterAction)
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
        $result = view('Organization::resevedIngredentSuppliers.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }



    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'suppliersIngredentReport.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

   


}