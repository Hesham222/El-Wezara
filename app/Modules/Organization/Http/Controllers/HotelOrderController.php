<?php
namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\HotelOrder\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction};
use Organization\Http\Requests\HotelOrder\{StoreRequest, UpdateRequest, RemoveRequest, FilterDateRequest};
use Organization\Exports\HotelOrder\{
    ExportData,
};
use Organization\Models\{Hotel,
    HotelInventory,
    HotelOrder,
    Ingredient,
    InventoryOrder,
    laundry,
    LaundryCategory,
    LaundryInventory,
    LaundryOrder,
    LaundryService,
    LaundrySubCategory};

class HotelOrderController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-View')
        ){
            return view('Organization::hotelOrders.index');
        }else
            return abort(401);
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-Add')
        ){
            $hotels = Hotel::all();
            $ingredients = Ingredient::whereIn('type',['hotel','all'])->get();
            return view('Organization::hotelOrders.create',compact('hotels','ingredients'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.hotelOrder.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-Edit')
        ){
            $record = laundryOrder::findOrFail($id);
            $services = LaundryService::all();
            $categories = LaundryCategory::all();
            $subCategories = LaundrySubCategory::all();
            return view('Organization::hotelOrders.edit', compact('services','categories','subCategories','record'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.hotelOrder.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::hotelOrders.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_hotelOrders_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-Delete')
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
        return HotelOrder::onlyTrashed()->count();
    }

    public function getServiceRow()
    {
        $ingredients = Ingredient::whereIn('type',['hotel','all'])->get();
        $results = view('Organization::hotelOrders.components.ingredient.row',compact('ingredients'),
            [
            ])->render();

        return $this->response(200, 'Service Row', 200, [], 0, ['responseHTML' => $results]);
    }

    public function cancelOrder(Request $request)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-Cancel-Order')
        ){
            $record = HotelOrder::find($request->input('id'));

            if ($record->status == "approved"){
                if ($record->hotelOrderIngredients){

                    foreach ($record->hotelOrderIngredients as $order_ing){
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
        $record         = HotelOrder::find($request->input('id'));
        $hotel = Hotel::find($record->hotel_id);
        if($record->status === "approved"){
            $record->status = "received";
            $record->save();
        }

        if($record->status === "received"){
            foreach($record->hotelOrderIngredients as $object){
                $check = HotelInventory::
                where('ingredient_id',$object->ingredient_id)
                    ->where('hotel_id',$hotel->id)->first();
                if($check != null){

                    $check->quantity = $check->quantity +$object->quantity;
                    $check->save();
                }
                else{

                    HotelInventory::create([
                        'ingredient_id'     =>  $object->ingredient_id,
                        'quantity'          =>  $object->quantity,
                        'hotel_id'          =>  $hotel->id
                    ]);
                }

            }
        }

        return $this->response(200, 'change status', 200, [], 0, $record->status);

    }




}
