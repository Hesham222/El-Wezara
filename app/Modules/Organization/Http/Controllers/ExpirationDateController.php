<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\ExpirationDate\{
    ExpirationDateFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\ExpirationDate\{
    ExpirationDateExportData,
};

use App\Http\Traits\FileTrait;

class ExpirationDateController extends JsonResponse
{
    use FileTrait;

    public function ExpirationDateIndex()
    {
        return view('Organization::ExpirationDate.ExpirationDate_index');
    }

    public function ExpirationDateData(FilterDateRequest $request, ExpirationDateFilterAction $filterAction)
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
        $result = view('Organization::ExpirationDate.components.ExpirationDate_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function ExpirationDateExport(FilterDateRequest $request, ExpirationDateFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExpirationDateExportData($records), 'ExpirationDate_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }


}
