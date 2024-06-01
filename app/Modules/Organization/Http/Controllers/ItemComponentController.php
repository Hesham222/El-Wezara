<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\ItemComponent\{
    ItemComponentFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\ItemComponent\{
    ItemComponentExportData,
};

use App\Http\Traits\FileTrait;

class ItemComponentController extends JsonResponse
{
    use FileTrait;

    public function ItemComponentIndex()
    {
        return view('Organization::ItemComponent.ItemComponent_index');
    }

    public function ItemComponentData(FilterDateRequest $request, ItemComponentFilterAction $filterAction)
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
        $result = view('Organization::ItemComponent.components.ItemComponent_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function ItemComponentExport(FilterDateRequest $request, ItemComponentFilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ItemComponentExportData($records), 'ItemComponent_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }


}
