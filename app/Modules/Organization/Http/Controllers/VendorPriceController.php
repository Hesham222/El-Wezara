<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\VendorPrice\{
    VendorPriceFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};
use Organization\Exports\VendorPrice\{
    VendorPriceExportData,
};

use App\Http\Traits\FileTrait;

class VendorPriceController extends JsonResponse
{
    use FileTrait;

    public function VendorPriceIndex()
    {
        return view('Organization::VendorPrice.vendorPrice_index');
    }

    public function VendorPriceData(FilterDateRequest $request, VendorPriceFilterAction $filterAction)
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
        $result = view('Organization::VendorPrice.components.vendorPrice_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function VendorPriceExport(FilterDateRequest $request, VendorPriceFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new VendorPriceExportData($records), 'VendorPrice_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }


}
