<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Employee;
use Organization\Actions\PointOfSale\{AssignIngredientsAction,
    CloseOrderAction,
    EndOrderAction,
    EndShiftAction,
    FilterAllOredersAction,
    FilterOredersAction,
    FilterPaymentAction,
    StartShiftAction,
    StoreAction,
    StoreOrderAction,
    StoreRetrievalOrderAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    UpdateOrderAction};
use Organization\Http\Requests\PointOfSale\{CloseOrderRequest,
    EndShiftRequest,
    StartShiftRequest,
    StoreOrrderRequest,
    StoreRequest,
    StoreRetrievalOrderRequest,
    UpdateOrrderRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest};
use Organization\Exports\PointOfSale\{
    ExportData,
};
use Organization\Models\{Ingredient,
    Item,
    ItemVariant,
    Order,
    PointOfSale,
    PointOfSaleInventory,
    PointOfSaleOrderSheet,
    PointOfSaleRetrievalOrder};

class PointOfSaleController extends JsonResponse
{


    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View')
        ){
            return view('Organization::pointOfSales.index');

        }else
            return abort(401);
    }


    public function payments($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Payments')
        ){
            $point_of_sale = PointOfSale::FindOrFail($id);
            return view('Organization::pointOfSales.payments.index',compact('point_of_sale'));
        }else
            return abort(401);

    }


    public function paymentsData(FilterDateRequest $request, FilterPaymentAction $filterAction,$id)
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
        $result = view('Organization::pointOfSales.payments.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function createRetrievalOrder($id)
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Retrieval-Order')
        ){
            $point_of_sale = PointOfSale::findOrFail($id);
            $allPoints = PointOfSale::whereNotIn('id',[$point_of_sale->id])->get();
            return view('Organization::pointOfSaleRetrievalOrder.create',compact('point_of_sale','allPoints'));
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
            return redirect()->route('organizations.pointOfSale.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }


    }


    public function getRetrievalOrders()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Retrieval-Orders')
        ){
            $orders = PointOfSaleRetrievalOrder::all();
            return view('Organization::pointOfSaleRetrievalOrder.index',compact('orders'));
        }else
            return abort(401);
    }


    public function approveRetrievalOrder($id)
    {
        DB::beginTransaction();
        try {
            $order = PointOfSaleRetrievalOrder::FindOrFail($id);

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

                    $check = PointOfSaleInventory::where('ingredient_id',$orderIngredent->ingredient_id)
                        ->where('PointOfSale_id',$order->resever_id)->first();
                    if($check != null){

                        $check->quantity = $check->quantity +$orderIngredent->quantity;
                        $check->save();
                    }
                    else{

                        PointOfSaleInventory::create([
                            'ingredient_id'     =>  $orderIngredent->ingredient_id,
                            'quantity'          =>  $orderIngredent->quantity,
                            'PointOfSale_id'           =>  $order->resever_id
                        ]);
                    }

                }

                $order->status = "approved";
                $order->save();

            }

            DB::commit();
            return redirect()->route('organizations.pointOfSale.get.retrieval.orders')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }


    }



    public function cancelRetrievalOrder($id)
    {
        DB::beginTransaction();
        try {

            $order = PointOfSaleRetrievalOrder::FindOrFail($id);


            foreach ($order->orderIngredents as $orderIngredent)
            {
                $prepAreaInvetory = PointOfSaleInventory::where('ingredient_id',$orderIngredent->ingredient_id)
                    ->where('PointOfSale_id',$order->sender_id)->first();

                $prepAreaInvetory->quantity += $orderIngredent->quantity;
                $prepAreaInvetory->save();
            }

            $order->status = "canceled";
            $order->save();

            DB::commit();
            return redirect()->route('organizations.pointOfSale.get.retrieval.orders')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function create()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Add')
        ){
            $employees = Employee::select(['id','name'])->get();
            $items = Item::select(['id','name'])->get();
            return view('Organization::pointOfSales.create',compact('employees','items'));
        }else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {

        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.pointOfSale.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {


        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Edit')
        ){
            $record = PointOfSale::findOrFail($id);

            $employees = Employee::select(['id','name'])->get();
            $items = Item::select(['id','name'])->get();
            return view('Organization::pointOfSales.edit', compact('record','employees','items'));
        }else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.pointOfSale.index')->with('success','Data has been saved successfully.');
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
        $result = view('Organization::pointOfSales.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_pointOfSales_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-Delete')
        ){
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'pointOfSales', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'pointOfSales', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'pointOfSales', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return PointOfSale::onlyTrashed()->count();
    }

    public function inventories($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-Inventories')
        ){
            $record = PointOfSale::find($id);
            $inventories = PointOfSaleInventory::where('PointOfSale_id',$record->id)->get();
            return view('Organization::pointOfSales.inventories',compact('inventories'));
        }else
            return abort(401);
    }

    public function makeOrder($id)
    {
        $point_of_sale = PointOfSale::FindOrFail($id);
        $startShift = PointOfSaleOrderSheet::where([ ['organization_admin_id',auth('organization_admin')->user()->id],['shift_date',Carbon::now()->format('Y-m-d')] ])->first();

//        if ($startShift && is_null($startShift->shift_end))
//            return redirect()->back()->with('error','لقد أغلقت الشيفت الخاص بك')->withInput();

        $ingredients = Ingredient::select(['id', 'name', 'quantity','final_cost','unit_measurement_id','cost'])
            ->where('type','pointOfSale')->orWhere('type','all')
            ->get();
        $items = Item::select(['id', 'name','final_cost','cost'])->get();
        $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
        $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();

        return view('Organization::pointOfSales.create_order',compact('point_of_sale','startShift','ingredients','items','item_variants'));

    }


    public function getIngredientsRow(Request $request)
    {
        $ingredients = Ingredient::select(['id','name','quantity','final_cost','unit_measurement_id','cost'])
            ->where('type','pointOfSale')
            ->get();

        $variant_item_ids = Item::where('type','Variant')->pluck('id');
        $item_variants = ItemVariant::whereIn('item_id',$variant_item_ids)->select(['id','name','final_cost','cost'])->get();
        $items = Item::select(['id','name','cost','final_cost'])->get();


        $results = view('Organization::pointOfSales.components.ingredients.row',
            [
                'items'=>$items,
                'item_variants'=>$item_variants,
                'ingredients' => $ingredients ,
            ])->render();

        return $this->response(200, 'Ingredients Row', 200, [], 0, ['responseHTML' => $results]);
    }


    public function getIngredientsTags(Request $request)
    {

        $tags_array =[];
        $cost = 0;
        $cal = 0;
        for ($i =0; $i < count($request->val1) ;$i++){

            if ($request->val3[$i] == 2){
                $ing = Item::find($request->val1[$i]);
            }elseif ($request->val3[$i] == 3){
                $ing = ItemVariant::find($request->val1[$i]);
            }
            else{
                $ing = Ingredient::find($request->val1[$i]);
            }

            if ($request->val2[$i] == null){
                if ($ing->final_cost == null){
                    $cost += 1 * $ing->cost;
                }else{
                    $cost += 1 * $ing->final_cost;
                }


            }else{

                if ($ing->final_cost == null){
                    $cost += $request->val2[$i] * $ing->cost;
                }else{
                    $cost += $request->val2[$i] * $ing->final_cost;

                }



            }


        }


        $data = array('cost'=>$cost,'cal'=>$cal);
        return $data;

    }


    public function startShift(StartShiftRequest $request, StartShiftAction $startShiftAction)
    {
        DB::beginTransaction();
        try {
            $startShiftAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.pointOfSale.make.order',$request->point_of_sale);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function storeOrder(StoreOrrderRequest $request,StoreOrderAction $storeAction, AssignIngredientsAction $assignIngredientsAction)
    {


        // return $request->all();
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            // try {
                $record = $storeAction->execute($request);

              $res =  $assignIngredientsAction->execute($request, $record);
              if($res['flag'] == 0){
                  return back()->with('error', ' ingredent quantity not enough');
              }elseif ($res['flag'] == 2){
                  return back()->with('error', ' no prepration area for some items');
              }
                DB::commit();

                if($res['area_id'] != null){
                    $this->firebaseService->refreshPrepArea($res['area_id']);
                }


                return back()->with('success', 'تم انشاء الاوردر');
            // } catch (\Exception $exception) {
                DB::rollback();
                // return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            // }
        }else
            return abort(401);

    }


    public function orders($id)
    {

        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-OrdersInProgress')
        ){
            $point_of_sale = PointOfSale::FindOrFail($id);
            return view('Organization::pointOfSales.orders.index',compact('point_of_sale'));
        }else
            return abort(401);

    }

    public function ordersData(FilterDateRequest $request, FilterOredersAction $filterAction ,$id)
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
        $result = view('Organization::pointOfSales.orders.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function allOrders()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'PointOfSale-View-All-Orders')
        ){
            return view('Organization::pointOfSales.allOrders.index');

        }else
            return abort(401);
    }

    public function allOrdersData(FilterDateRequest $request, FilterAllOredersAction $filterAction )
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
        $result = view('Organization::pointOfSales.allOrders.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function endShift(EndShiftRequest $request, EndShiftAction $endShiftAction)
    {
        DB::beginTransaction();
        try {

            $endShiftAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.pointOfSale.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }


    public function closeOrderView($id)
    {
        $order = Order::FindOrFail($id);
        $employees = Employee::all();
        return view('Organization::pointOfSales.orders.close',compact('order','employees'));
    }

    public function editOrderView($id)
    {
        $order = Order::FindOrFail($id);
        $ingredients = Ingredient::select(['id', 'name', 'quantity','final_cost','unit_measurement_id','cost'])
            ->where('type','pointOfSale')
            ->get();
        $items = Item::select(['id', 'name','final_cost','cost'])->get();
        $variant_item_ids = Item::where('type', 'Variant')->pluck('id');
        $item_variants = ItemVariant::whereIn('item_id', $variant_item_ids)->select(['id', 'name','final_cost' ,'cost'])->get();

        return view('Organization::pointOfSales.edit_order',compact('order','ingredients','items','item_variants'));

    }

    public function updateOrder(UpdateOrrderRequest $request,UpdateOrderAction $updateOrderAction, AssignIngredientsAction $assignIngredientsAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Add')
        ) {
            DB::beginTransaction();
            try {
                $record = $updateOrderAction->execute($request);
                $res =  $assignIngredientsAction->execute($request, $record);
                if($res == 0){
                    return back()->with('error', ' ingredent quantity not enough');
                }elseif ($res == 2){
                    return back()->with('error', ' no prepration area for some items');
                }
                DB::commit();
                return redirect()->route('organizations.pointOfSale.orders',$record->point_of_sale_id)->with('success', 'تم انشاء الاوردر');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }
        }else
            return abort(401);

    }

    public function closeOrder(EndOrderAction $endOrderAction , $id)
    {
        DB::beginTransaction();
        try {
            $endOrderAction->execute($id);
            DB::commit();
            return back()->with('success','تم انهاء الطلب');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function closeOrderPayment(CloseOrderRequest $request, CloseOrderAction $closeOrderAction)
    {
        DB::beginTransaction();
        try {
           $res = $closeOrderAction->execute($request);
            DB::commit();
            if ($res == 0){
                return back()->with('error','برجاء التاكد من حجز الغرفة او رقم العميل التعريفي');

            }
            return redirect()->route('organizations.pointOfSale.orders',$res)->with('success','تم انهاء الطلب');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }

    }


}
