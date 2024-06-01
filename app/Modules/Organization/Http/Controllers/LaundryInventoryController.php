<?php
namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\LaundryInventory\{FilterAction};
use Organization\Http\Requests\LaundryOrder\{addPayment, StoreRequest, UpdateRequest, RemoveRequest, FilterDateRequest};
use Organization\Exports\LaundryOrder\{
    ExportData,
};
use Organization\Models\{laundry,
    LaundryCategory,
    LaundryInventory,
    LaundryInventoryConsumption,
    LaundryOrder,
    LaundryService,
    LService,
    LaundrySubCategory,
    LaundrySubCategoryService};

class LaundryInventoryController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventory-View')
        ){
            return view('Organization::laundryInventories.index');
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
        $result = view('Organization::laundryInventories.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_laundryOrders_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function consumption($id){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventory-consumption')
        ){
            $record = LaundryInventory::find($id);
            return view('Organization::laundryInventories.consumption',compact('record'));
        }else
            return abort(401);
    }

    public function save(Request $request){
        DB::beginTransaction();
        try{
            $inventory = LaundryInventory::find($request->input('inventory'));
            LaundryInventoryConsumption::create([
                'inventory_id'=>$request->input('inventory'),
                'old_quantity'=>$inventory->quantity,
                'used_quantity'=>$request->input('used'),
                'new_quantity'=>$request->input('new_quantity'),
                'created_by' => auth('organization_admin')->user()->id,

            ]);
            $inventory->quantity = $request->input('new_quantity');
            $inventory->save();
            DB::commit();
            return view('Organization::laundryInventories.index')->with('success','Data has been saved successfully.');
        }
          catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }



}
