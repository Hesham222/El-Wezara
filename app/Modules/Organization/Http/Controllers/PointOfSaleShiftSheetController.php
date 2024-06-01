<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PointOfSaleShiftSheet\{
    FilterAction,
};
use Organization\Http\Requests\PointOfSaleShiftSheet\{
    FilterDateRequest
};
use Organization\Exports\PointOfSaleShiftSheet\{
    ExportData,
};

class PointOfSaleShiftSheetController extends JsonResponse
{
    
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationAreaInventory-View-ShiftDetails')
        ){
            return view('Organization::pointOfSaleShiftSheets.index');

        }else
            return abort(401);
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
        $result = view('Organization::pointOfSaleShiftSheets.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_pointOfSaleShiftSheets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }
}
