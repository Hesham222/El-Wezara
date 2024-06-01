<?php
namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\PreparationAreaInventory\{FilterAction};
use Organization\Http\Requests\LaundryOrder\{
    FilterDateRequest};
use Organization\Exports\LaundryOrder\{
    ExportData,
};
use Organization\Models\{PointOfSaleInventory,
    PointOfSaleInventoryConsumption,
    PreparationAreaInventory,
    PreparationAreaInventoryConsumption};

class PreparationAreaInventoryController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationAreaInventory-View')
        ){
            return view('Organization::preparationAreaInventories.index');

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
        $result = view('Organization::preparationAreaInventories.components.table_body',compact('records'))->render();
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

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationAreaInventory-consumption')
        ){
            $record = PreparationAreaInventory::find($id);
            return view('Organization::preparationAreaInventories.consumption',compact('record'));
        }else
            return abort(401);
    }

    public function save(Request $request){
        DB::beginTransaction();
        try{
            $inventory = PreparationAreaInventory::find($request->input('inventory'));
            PreparationAreaInventoryConsumption::create([
                'inventory_id'=>$request->input('inventory'),
                'old_quantity'=>$inventory->quantity,
                'used_quantity'=>$request->input('used'),
                'new_quantity'=>$request->input('new_quantity'),
                'created_by' => auth('organization_admin')->user()->id,

            ]);
            $inventory->quantity = $request->input('new_quantity');
            $inventory->save();
            DB::commit();
            return view('Organization::preparationAreaInventories.index')->with('success','Data has been saved successfully.');
        }
          catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }



}
