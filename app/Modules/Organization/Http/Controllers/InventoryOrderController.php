<?php
namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\InventoryOrder\{ChangeStatusAction,
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction};
use Organization\Http\Requests\InventoryOrder\{StoreRequest, UpdateRequest, RemoveRequest, FilterDateRequest};
use Organization\Exports\LaundryOrder\{
    ExportData,
};
use Organization\Models\{Ingredient, InventoryOrder, laundry, LaundryInventory};
use Organization\Models\LaundryCategory;
use Organization\Models\LaundryOrder;
use Organization\Models\LService;
use Organization\Models\LaundrySubCategory;

class InventoryOrderController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventoryOrder-View')
        ){
            return view('Organization::inventoryOrders.index');
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventoryOrder-Add')
        ){
            $laundries = laundry::all();
            $ingredients = Ingredient::all();
            return view('Organization::inventoryOrders.create',compact('laundries','ingredients'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.inventoryOrder.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventoryOrder-Edit')
        ){
            $record = LaundryOrder::findOrFail($id);
            $services = LService::all();
            $categories = LaundryCategory::all();
            $subCategories = LaundrySubCategory::all();
            return view('Organization::inventoryOrders.edit', compact('services','categories','subCategories','record'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.inventoryOrder.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
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
        $result = view('Organization::inventoryOrders.components.table_body',compact('records'))->render();
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

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventoryOrder-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'laundryOrders', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }else
            return abort(401);
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'laundryOrders', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'laundryOrders', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return InventoryOrder::onlyTrashed()->count();
    }

    public function getServiceRow()
    {
        $ingredients = Ingredient::all();
        $results = view('Organization::inventoryOrders.components.ingredient.row',compact('ingredients'),
            [
            ])->render();

        return $this->response(200, 'Service Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function cancelOrder(Request $request){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'LaundryInventoryOrder-Cancel-Order')
        ){

            $record = InventoryOrder::find($request->input('id'));
            if ($record->status == "approved"){
                if ($record->inventoryOrderIngredients){

                    foreach ($record->inventoryOrderIngredients as $order_ing){
                        $order_ing->ingredient->quantity +=$order_ing->quantity;
                        $order_ing->ingredient->save();
                    }

                }
            }
            $record->status = "cancelled";
            $record->save();
            return $this->response(200, 'cancel order', 200, [], 0, $record->status);
        }else
            return abort(401);
    }

    public function changeStatus(Request $request){
        $record         = InventoryOrder::find($request->input('id'));
        $laundry = laundry::find($record->laundry_id);
        if($record->status === "approved"){
            $record->status = "received";
            $record->save();
        }

        if($record->status === "received"){
            foreach($record->inventoryOrderIngredients as $object){
                $check = LaundryInventory::
                where('ingredient_id',$object->ingredient_id)
                    ->where('laundry_id',$laundry->id)->first();
                if($check != null){

                    $check->quantity = $check->quantity +$object->quantity;
                    $check->save();
                }
                else{

                    LaundryInventory::create([
                        'ingredient_id'     =>  $object->ingredient_id,
                        'quantity'          =>  $object->quantity,
                        'laundry_id'        =>  $laundry->id
                    ]);
                }

            }
        }

        return $this->response(200, 'change status', 200, [], 0, $record->status);

    }

    public function consumption($id){
            return view('Organization::inventoryOrders.consumption');

    }



}
