<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Employee;
use Organization\Actions\PreparationArea\{FilterOrderItemsAction,
    FilterReservationsItemsAction,
    MakeItemAction,
    StoreAction,
    StoreManufacturedIngsAction,
    StoreRetrievalOrderAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction};
use Organization\Http\Requests\PreparationArea\{StoreManufacturedIngsRequest,
    StoreRequest,
    StoreRetrievalOrderRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest};
use Organization\Exports\PreparationArea\{
    ExportData,
};
use Organization\Models\{Ingredient,
    MenuCategory,
    OrderItem,
    PreparationArea,
    PreparationAreaCategory,
    PreparationAreaInventory,
    PreparationAreaRetrievalOrder};

class PreparationAreaController extends JsonResponse
{

    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View')
        ){
            return view('Organization::preparationAreas.index');

        }else
            return abort(401);
    }



    public function createRetrievalOrder($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View')
        ){
            $area = PreparationArea::findOrFail($id);
            $allAreas = PreparationArea::whereNotIn('id',[$area->id])->get();
            return view('Organization::preparationRetrievalOrder.create',compact('area','allAreas'));
        }else
            return abort(401);
    }

    public function storeRetrievalOrder(StoreRetrievalOrderRequest $request, StoreRetrievalOrderAction $storeAction)
    {
        DB::beginTransaction();
        try {
          $res =   $storeAction->execute($request);
          if ($res == 0){
              return back()->with('error','لا يوجد لديك ف المخزن ما يكفى من الكمية لارجاعها');

          }
            DB::commit();
            return redirect()->route('organizations.preparationArea.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }


    }


    public function storeManufacturedIngs(StoreManufacturedIngsRequest $request, StoreManufacturedIngsAction $storeAction)
    {


        DB::beginTransaction();
        try {
            $res =   $storeAction->execute($request);
            if ($res == 0){
                return back()->with('error','لا يوجد لديك ف المخزن ما يكفى من الكمية لتصنيعها');

            }
            DB::commit();
            return redirect()->route('organizations.preparationArea.inventories',$res)->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }

    }


    public function getRetrievalOrders()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View-Retrieval-Orders')
        ){
            $orders = PreparationAreaRetrievalOrder::all();
            return view('Organization::preparationRetrievalOrder.index',compact('orders'));
        }else
            return abort(401);
    }

    public function mortalIngredent($id)
    {
        $inventory = PreparationAreaInventory::findOrFail($id);
        return view('Organization::preparationAreas.mortal',compact('inventory'));

    }

    public function calcManufacturedQty(Request $request)
    {
        $inventory = PreparationAreaInventory::findOrFail($request->inventory);

        $amount = $request->quantity * $inventory->ingredient->quantity ;

        return $amount;
    }

    public function getCalc_cost(Request $request)
    {
        $qtny = $request->quantity;
        $ing_id = $request->ing_id;
        $qtny_munifactured = $request->manifactured_quantity;
        $inventoryQty = $request->inventoryQty;

        $ing = Ingredient::FindOrFail($ing_id);

        $cost_of_inventory_qty = $ing->final_cost * $inventoryQty ;

        $cost = ($qtny * $cost_of_inventory_qty) / $qtny_munifactured ;

        return $cost;
    }


    public function approveRetrievalOrder($id)
    {
        DB::beginTransaction();
        try {
            $order = PreparationAreaRetrievalOrder::FindOrFail($id);

            if ($order->type == 'general')
            {

                foreach ($order->orderIngredents as $orderIngredent)
                {

                    $ing = Ingredient::where('id',$orderIngredent->ingredient_id)->first();
                    $ing->stock += $orderIngredent->quantity;
                    $ing->save();
                }

                $order->status = "approved";
                $order->save();
            }else
            {
                foreach ($order->orderIngredents as $orderIngredent)
                {

                    $check = PreparationAreaInventory::where('ingredient_id',$orderIngredent->ingredient_id)
                        ->where('area_id',$order->resever_id)->first();
                    if($check != null){

                        $check->quantity = $check->quantity +$orderIngredent->quantity;
                        $check->save();
                    }
                    else{

                        PreparationAreaInventory::create([
                            'ingredient_id'     =>  $orderIngredent->ingredient_id,
                            'quantity'          =>  $orderIngredent->quantity,
                            'area_id'           =>  $order->resever_id
                        ]);
                    }

                }

                $order->status = "approved";
                $order->save();

            }

            DB::commit();
            return redirect()->route('organizations.preparationArea.get.retrieval.orders')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }


    }



    public function cancelRetrievalOrder($id)
    {
        DB::beginTransaction();
        try {

            $order = PreparationAreaRetrievalOrder::FindOrFail($id);


            foreach ($order->orderIngredents as $orderIngredent)
            {
                $prepAreaInvetory = PreparationAreaInventory::where('ingredient_id',$orderIngredent->ingredient_id)
                    ->where('area_id',$order->sender_id)->first();

                $prepAreaInvetory->quantity += $orderIngredent->quantity;
                $prepAreaInvetory->save();
            }

            $order->status = "canceled";
            $order->save();

            DB::commit();
            return redirect()->route('organizations.preparationArea.get.retrieval.orders')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }


    }

    public function viewOrdersItmes($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Order-Items')
        ){
            $record = PreparationArea::findOrFail($id);
            return view('Organization::preparationAreas.ordersItems.index',compact('record'));
        }else
            return abort(401);
    }

    public function viewReservationsItmes($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Reservation-Items')
        ){
            $record = PreparationArea::findOrFail($id);
            return view('Organization::preparationAreas.reservationsItems.index',compact('record'));
        }else
            return abort(401);
    }

    public function viewOrdersItmeDetail($id)
    {
        $order_item = OrderItem::findOrFail($id);
        return view('Organization::preparationAreas.ordersItems.show',compact('order_item'));

    }

    public function orderItmeReady(MakeItemAction $storeAction,$id)
    {
        DB::beginTransaction();
        try {
         $res =   $storeAction->execute($id);
         if ($res == 0){
             return back()->with('error','تحتاج بعض المكونات لتحضير هذا المنتج');

         }

         DB::commit();
            return back()->with('success','تم تجهيز المنتج');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }

    }


    public function orderShortcomings($id)
    {

        DB::beginTransaction();
        try {

          $orderItem = OrderItem::FindOrFail($id);
          $orderItem->prep_area->shortcomings($orderItem->item,$orderItem->quantity);
            DB::commit();
            return back()->with('success','تم ارسال الطلب');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }

    }


    public function ordersItemData(FilterDateRequest $request, FilterOrderItemsAction $filterAction,$id)
    {
        $records = $filterAction->execute($request,$id)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::preparationAreas.ordersItems.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function reservationsItemData(FilterDateRequest $request, FilterReservationsItemsAction $filterAction,$id)
    {
        $records = $filterAction->execute($request,$id)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::preparationAreas.reservationsItems.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);


    }


    public function create()
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Add')
        ){
            $employees = Employee::select(['id','name'])->get();
            $selected_categories = PreparationAreaCategory::pluck('category_id');
            $categories = MenuCategory::select(['id','name'])->whereNotIn('id',$selected_categories)->get();
            return view('Organization::preparationAreas.create',compact('employees','categories'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
      //  return $request->all();
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.preparationArea.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Edit')
        ){
            $record = PreparationArea::findOrFail($id);

            $employees = Employee::select(['id','name'])->get();
            $selected_categories = PreparationAreaCategory::whereNotIn('area_id',[$record->id])->pluck('category_id');

            $categories = MenuCategory::select(['id','name'])->whereNotIn('id',$selected_categories)->get();
            return view('Organization::preparationAreas.edit', compact('record','employees','categories'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.preparationArea.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::preparationAreas.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_preparation_areas_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
               return back()->with('success','Data moved to trash successfully.');
               // return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'laundryServices', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'laundryServices', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'laundryServices', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return PreparationArea::onlyTrashed()->count();
    }

    public function inventories($id){

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PreparationArea-View-Inventories')
        ){
            $record = PreparationArea::find($id);
            $inventories = PreparationAreaInventory::where('area_id',$record->id)->get();
            return view('Organization::preparationAreas.inventories',compact('inventories'));
        }else
            return abort(401);
    }
}
