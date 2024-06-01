<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\SpenPermission\{
    HotelFilterAction,LaundryFilterAction,PoFilterAction,PrepFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest,BankSupplyRequest
};
use Organization\Exports\SpenPermission\{
    HotelExportData,LuandryExportData,PoExportData,PrepExportData,
};

use Illuminate\Support\Facades\DB;
use Organization\Models\PointOfSaleOrderSheet;
use Organization\Models\SafeReceipt;
use Organization\Models\BankSupply;


use App\Http\Traits\FileTrait;



class SpenPermissionController extends JsonResponse
{
    use FileTrait;
    
    public function hotelSpendPermissionindex()
    {
        return view('Organization::SpenPermission.hotel_index');
    }

 

    public function hotelSpendPermissionData(FilterDateRequest $request, HotelFilterAction $filterAction)
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
        $result = view('Organization::SpenPermission.components.hotel_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function hotelSpendPermissionExport(FilterDateRequest $request, HotelFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new LuandryExportData($records), 'hotel_SpenPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }







    public function laundrySpendPermissionindex()
    {
        return view('Organization::SpenPermission.laundry_index');
    }

 

    public function laundrySpendPermissionData(FilterDateRequest $request, LaundryFilterAction $filterAction)
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
        $result = view('Organization::SpenPermission.components.laundry_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function laundrySpendPermissionExport(FilterDateRequest $request, LaundryFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new HotelExportData($records), 'laundry_SpenPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }
















    public function poSpendPermissionindex()
    {
        return view('Organization::SpenPermission.po_index');
    }

 

    public function poSpendPermissionData(FilterDateRequest $request, PoFilterAction $filterAction)
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
        $result = view('Organization::SpenPermission.components.po_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function poSpendPermissionExport(FilterDateRequest $request, PoFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PoExportData($records), 'po_SpenPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }












    public function prepSpendPermissionindex()
    {
        return view('Organization::SpenPermission.prep_index');
    }

 

    public function prepSpendPermissionData(FilterDateRequest $request, PrepFilterAction $filterAction)
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
        $result = view('Organization::SpenPermission.components.prep_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function prepSpendPermissionExport(FilterDateRequest $request, PrepFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PrepExportData($records), 'prep_SpenPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }



   


}