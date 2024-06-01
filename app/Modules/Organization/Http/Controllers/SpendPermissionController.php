<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\SpendPermission\{
    HotelFilterAction,LaundryFilterAction,PoFilterAction,PrepFilterAction,PurchaseFilterAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest,BankSupplyRequest
};
use Organization\Exports\SpenPermission\{
    HotelExportData,PurchaseExportData,LuandryExportData,PoExportData,PrepExportData,
};

use App\Http\Traits\FileTrait;



class SpendPermissionController extends JsonResponse
{
    use FileTrait;

    public function hotelSpendPermissionindex()
    {
        return view('Organization::SpendPermission.hotel_index');
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
        $result = view('Organization::SpendPermission.components.hotel_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function hotelSpendPermissionExport(FilterDateRequest $request, HotelFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new HotelExportData($records), 'hotel_SpendPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }







    public function laundrySpendPermissionindex()
    {
        return view('Organization::SpendPermission.laundry_index');
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
        $result = view('Organization::SpendPermission.components.laundry_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function laundrySpendPermissionExport(FilterDateRequest $request, LaundryFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new LuandryExportData($records), 'laundry_SpendPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }
















    public function poSpendPermissionindex()
    {
        return view('Organization::SpendPermission.po_index');
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
        $result = view('Organization::SpendPermission.components.po_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function poSpendPermissionExport(FilterDateRequest $request, PoFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PoExportData($records), 'po_SpendPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }












    public function prepSpendPermissionindex()
    {
        return view('Organization::SpendPermission.prep_index');
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
        $result = view('Organization::SpendPermission.components.prep_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function prepSpendPermissionExport(FilterDateRequest $request, PrepFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PrepExportData($records), 'prep_SpendPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }

    public function purchaseSpendPermissionIndex()
    {
        return view('Organization::SpendPermission.purchase_index');
    }



    public function purchaseSpendPermissionData(FilterDateRequest $request, PurchaseFilterAction $filterAction)
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
        $result = view('Organization::SpendPermission.components.purchase_table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function purchaseSpendPermissionExport(FilterDateRequest $request, PurchaseFilterAction $filterAction)
    {

        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new PurchaseExportData($records), 'purchase_SpendPermission_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }

    }




}
