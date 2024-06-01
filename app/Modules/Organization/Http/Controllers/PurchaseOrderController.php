<?php

namespace Organization\Http\Controllers;


use Admin\Models\Status;
use App\Events\Organization\ChangePOStatusEvent;
use App\Events\Organization\StoreCheckInPOItemsEvent;
use App\Events\Organization\StorePOItemsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Organization\Actions\Ingredient\FilterAction;
use Organization\Http\Requests\PO\StorePurchaseOrder;
use Organization\Http\Requests\PO\UpdatePOCheckInRequest;
use Organization\Http\Requests\PO\UpdatePurchaseOrder;
use Organization\Models\HotelOrder;
use Organization\Models\Ingredient;
use Organization\Models\InventoryOrder;
use Organization\Models\PointOfSaleOrder;
use Organization\Models\PreparationAreaOrder;
use Organization\Models\PurchaseOrder;
use Organization\Models\Setting;
use Organization\Models\Vendor;
use Organization\Models\AddOrder;

class PurchaseOrderController extends JsonResponse
{

    public function index()
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {
            $POsManagement = true;
            $POs = PurchaseOrder::all();
            return view('Organization::purchaseOrders.index', compact('POsManagement' , 'POs'));
        }else
            return abort(401);
    }



    public function inventoriesIndex()
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {

            $hotel_orders = HotelOrder::with(['hotelOrderIngredients','hotel'])->get();
            $laundry_orders = InventoryOrder::with(['inventoryOrderIngredients','laundry'])->get();
            $point_of_sale_orders = PointOfSaleOrder::with(['PointOrderIngredients','PointOfSale'])->get();
            $prepration_area_orders = PreparationAreaOrder::with(['AreaOrderIngredients','area'])->get();
            return view('Organization::purchaseOrders.inventoriesIndex',
                compact( 'hotel_orders','laundry_orders','point_of_sale_orders','prepration_area_orders'));
        }else
            return abort(401);
    }

    public function ordersIngredients()
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {

            $hotel_orders = HotelOrder::with(['hotelOrderIngredients','hotel'])->get();
            $laundry_orders = InventoryOrder::with(['inventoryOrderIngredients','laundry'])->get();
            $point_of_sale_orders = PointOfSaleOrder::with(['PointOrderIngredients','PointOfSale'])->get();
            $prepration_area_orders = PreparationAreaOrder::with(['AreaOrderIngredients','area'])->get();

           $ings =[];

           foreach ($hotel_orders as $hotel_order){
               if ($hotel_order->hotelOrderIngredients) {

                   foreach ($hotel_order->hotelOrderIngredients as $ingredient){

                       array_push($ings,$ingredient->ingredient_id);
                   }

               }
           }


            foreach ($laundry_orders as $laundry_order){
                if ($laundry_order->inventoryOrderIngredients) {

                    foreach ($laundry_order->inventoryOrderIngredients as $ingredient){

                        array_push($ings,$ingredient->ingredient_id);
                    }

                }
            }


            foreach ($point_of_sale_orders as $point_of_sale_order){
                if ($point_of_sale_order->PointOrderIngredients) {

                    foreach ($point_of_sale_order->PointOrderIngredients as $ingredient){

                        array_push($ings,$ingredient->ingredient_id);
                    }

                }
            }


            foreach ($prepration_area_orders as $prepration_area_order){
                if ($prepration_area_order->AreaOrderIngredients) {

                    foreach ($prepration_area_order->AreaOrderIngredients as $ingredient){

                        array_push($ings,$ingredient->ingredient_id);
                    }

                }
            }
            $result = array();
            foreach ($ings as $key => $value){
                if(!in_array($value, $result))
                    array_push($result,$value);
            }

            $ingredients = Ingredient::whereIn('id',$result)->get();

            return view('Organization::purchaseOrders.orders_items',
                compact( 'ingredients'));
        }else
            return abort(401);
    }

    //return view of create new PO
    public function create()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ){
            $status    = Status::where('id',1)->first();
            $vendors   = Vendor::all();
            $setting = Setting::first();

            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 0;
                $setting->save();
            }

            return view('Organization::purchaseOrders.create', compact('setting','vendors','status'));
        }
        else
            return abort(401);
    }

    public function createPoOrder($id,$type=null)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ){
            $status    = Status::where('id',1)->first();
            $vendors   = Vendor::all();
            $setting = Setting::first();

            if (!$setting){
                $setting = new Setting();
                $setting->dynamic_percentage = 0;
                $setting->save();
            }


            if ($type == 'hotel'){
                $order = HotelOrder::FindOrFail($id);
            }elseif ($type == 'laundry'){
                $order = InventoryOrder::FindOrFail($id);
            }elseif ($type == 'point'){
                $order = PointOfSaleOrder::FindOrFail($id);
            }elseif ($type == 'prepration'){
                $order = PreparationAreaOrder::FindOrFail($id);
            }else{
                return abort(401);
            }


            return view('Organization::purchaseOrders.create', compact('setting','vendors','status','order','type'));
        }
        else
            return abort(401);

    }


    public function createPoOrderIngredient($id,$qnt=null)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ){
            $status    = Status::where('id',1)->first();
            $vendors   = Vendor::all();
            $setting = Setting::first();

            $ingredient = Ingredient::FindOrFail($id);


            return view('Organization::purchaseOrders.create', compact('setting','vendors','status','ingredient','qnt'));
        }
        else
            return abort(401);

    }

    //store po data
    public function store(StorePurchaseOrder $request)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {
            $input = $request->all();
            //prevent to make create PO without items with ordered status
            if ($input['status'] == 2) {
                if (!request()->has('items'))
                    return back()->with('error', 'يجب ان يحتوى الطلب على الاقل على منتج')->withInput();
                elseif (request()->has('items') and !request('items')[0])
                    return back()->with('error', 'يجب ان يحتوى الطلب على الاقل على منتج')->withInput();
            }

            DB::beginTransaction();
            try {
                $po = PurchaseOrder::create([
                    'status_id' => $input['status'],
                    'vendor_id' => $input['vendor'],
                    'reference_number' => $input['ReferenceNum'],
                    'ordered_date' => $input['orderDate'],
                    'expected' => $input['expexted'],
                    'shipping_note' => $input['shippingNote'],
                    'general_notes' => $input['generalNotes'],
                    'shipping_cost' => $input['shippingCost'],
                    'total_after_shipping' => $input['totalAfterShipping'],
                    'subtotal' => $input['subtotal'],
                    'discount_amount' => $input['shippingDisc'],
                    'total_disc' => $input['total_disc'],
                    'vat' => $input['vat'],
                    'total' => $input['total'],
                    'remaining' => $input['total'],

                    'bounes_quantity' => $input['bounes_quantity'],
                    'adding_bounes_quantity' => $input['adding_bounes_quantity'],
                ]);
                //store items of po
                event(new StorePOItemsEvent($po->id));
                //store histoy of statues chenge of po
                event(new ChangePOStatusEvent($po->id, $po->status_id));
                DB::commit();
                session()->flash('_added', 'تم انشاء الطلب ');
                return redirect()->route('organizations.po.index');
                // return redirect()->route('accounts.po.edit',$po->id);
            } catch (\Exception $exception) {
                DB::rollback();
                abort(500);
            }

        } else
            return abort(401);
    }

    //return view of po edit page
    public function edit($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {
            $po = PurchaseOrder::findOrFail($id);
            if ($po->status ? $po->status->id != 1 and $po->status->id != 2 and $po->status->id != 3 : 0)
                abort(404);

            $vendors = Vendor::all();
            $setting = Setting::first();
            if ($po->status ? $po->status->id == 1 : 0)
                return view('Organization::purchaseOrders.edit', compact('po','setting', 'vendors'));
            if ($po->status ? $po->status->id == 3 : 0)
                return view('Organization::purchaseOrders.editCheckIn', compact('po','setting', 'vendors'));

        }else
            return abort(401);
    }

    //update po data with status open
    public function update(UpdatePurchaseOrder $request, $id)
    {

        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {
            $input = $request->all();
            //prevent change status of po to ordered without  add items
            if ($input['status'] == 2) {
                if (!request()->has('items'))
                    return back()->with('error', 'يجب ان يحتوى الطلب على الاقل على منتج')->withInput();
                elseif (request()->has('items') and !request('items')[0])
                    return back()->with('error', 'يجب ان يحتوى الطلب على الاقل على منتج')->withInput();
            }
            $po = PurchaseOrder::findOrFail($id);
            DB::beginTransaction();
            try {
                $po->update([
                    'status_id' => $input['status'],
                    'vendor_id' => $input['vendor'],
                    'reference_number' => $input['ReferenceNum'],
                    'ordered_date' => $input['orderDate'],
                    'expected' => $input['expexted'],
                    'shipping_note' => $input['shippingNote'],
                    'general_notes' => $input['generalNotes'],
                    'shipping_cost' => $input['shippingCost'],
                    'total_after_shipping' => $input['totalAfterShipping'],
                    'subtotal' => $input['subtotal'],
                    'discount_amount' => $input['shippingDisc'],
                    'total_disc' => $input['total_disc'],
                    'vat' => $input['vat'],
                    'total' => $input['total'],
                    'remaining' => $input['total'],
                    'bounes_quantity' => $input['bounes_quantity'],
                    'adding_bounes_quantity' => $input['adding_bounes_quantity'],
                ]);
                $po->save();
                foreach ($po->items as $item) {
                    $item->delete();
                }
                event(new StorePOItemsEvent($po->id));
                //store histoy of statues chenge of po
                event(new ChangePOStatusEvent($po->id, $po->status_id));
                DB::commit();
                session()->flash('_updated', 'تم تحديث الطلب');
                return redirect()->route('organizations.po.index');
                // return redirect()->back();
            } catch (\Exception $exception) {
                DB::rollback();
                abort(500);
            }
        }else
            return abort(401);
    }
    //update data of po data with status receving(check in)
    public function updateCheckIn(UpdatePOCheckInRequest $request,$id){
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {
            $input = $request->all();
            $input['receivedToInventory'] ? $status = 4 : $status = 3;
            $po = PurchaseOrder::findOrFail($id);
            DB::beginTransaction();
            try {
                $po->update([
                    'status_id' => $status,
                    'completed_date' => $status == 4 ? date("Y-m-d") : null,
                    'check_in_comments' => $input['checkInComments'],
                    'shipping_cost' => $input['shippingCost'],
                    'subtotal' => $input['subtotal'],
                    'discount_amount' => $input['shippingDisc'],
                    'total_disc' => $input['total_disc'],
                    'vat' => $input['vat'],
                    'total' => $input['total'],
                    'remaining' => $input['total'],
                    'bounes_quantity' => $input['bounes_quantity'],
                    'adding_bounes_quantity' => $input['adding_bounes_quantity'],

                ]);
                $po->save();
                event(new StoreCheckInPOItemsEvent($po->id));
                //store histoy of statues chenge of po
                event(new ChangePOStatusEvent($po->id, $po->status_id));
                // add aading order to po
                $new_add_order = new AddOrder();
                $new_add_order->created_by = auth('organization_admin')->user()->id;
                $new_add_order->purchase_order_id = $po->id ;
                $new_add_order->save();
                DB::commit();
                session()->flash('_updated','تم تحديث حالةالطلب');
                return redirect()->route('organizations.po.index');
                // return redirect()->back();
            } catch (\Exception $exception) {
                DB::rollback();
                abort(500);
            }
        }else
            return abort(401);

    }
    public function show($id){
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {


            $po = PurchaseOrder::findOrFail($id);
          //return   $po->add_order;
            $setting = Setting::first();
            return view('Organization::purchaseOrders.show', compact('po', 'setting'));

        }else
            return abort(401);
    }

    public function inventoriesorderDetail($id,$type=null)
    {
        if ($type == 'hotel'){
            $order = HotelOrder::FindOrFail($id);
        }elseif ($type == 'laundry'){
            $order = InventoryOrder::FindOrFail($id);
        }elseif ($type == 'point'){
            $order = PointOfSaleOrder::FindOrFail($id);
        }elseif ($type == 'prepration'){
            $order = PreparationAreaOrder::FindOrFail($id);
        }else{
            return abort(401);
        }

        return view('Organization::purchaseOrders.showOrder', compact('type','order'));

    }

    public function refuseOrder($id,$type=null)
    {


        if ($type == 'hotel'){
            $order = HotelOrder::FindOrFail($id);
        }elseif ($type == 'laundry'){
            $order = InventoryOrder::FindOrFail($id);
        }elseif ($type == 'point'){
            $order = PointOfSaleOrder::FindOrFail($id);
        }elseif ($type == 'prepration'){
            $order = PreparationAreaOrder::FindOrFail($id);
        }else{
            return abort(401);
        }

        return view('Organization::purchaseOrders.refuse_order', compact('type','order'));

    }

    public function storeFefuseOrderReason(Request $request)
    {

        if ($request->type == 'hotel'){
            $order = HotelOrder::FindOrFail($request->order_id);
        }elseif ($request->type == 'laundry'){
            $order = InventoryOrder::FindOrFail($request->order_id);
        }elseif ($request->type == 'point'){
            $order = PointOfSaleOrder::FindOrFail($request->order_id);
        }elseif ($request->type == 'prepration'){
            $order = PreparationAreaOrder::FindOrFail($request->order_id);
        }else{
            return abort(401);
        }

        $order->status = 'rejected' ;
        $order->rejection_reason = $request->reason ;
        $order->save();


        session()->flash('_updated','تم تحديث حالةالطلب');
        return redirect()->route('organizations.po.inventoriesIndex');

    }


    public function fullFillOrder($id,$type=null)
    {

            if ($type == 'hotel') {
                $order = HotelOrder::FindOrFail($id);
                if ($order->calc_fullFillOrder() && $order->calc_exp_date_order()) {
                    foreach ($order->hotelOrderIngredients as $order_ing) {
                        $order_ing->ingredient->stock -= $order_ing->quantity;
                        $order_ing->ingredient->save();
                        $order->substactIngredentQuantity();
                    }

                    $order->status = "approved";
                    $order->save();
                }
            } elseif ($type == 'laundry') {
                $order = InventoryOrder::FindOrFail($id);
                if ($order->calc_fullFillOrder() && $order->calc_exp_date_order()) {
                    foreach ($order->inventoryOrderIngredients as $order_ing) {
                        $order_ing->ingredient->stock -= $order_ing->quantity;
                        $order_ing->ingredient->save();
                        $order->substactIngredentQuantity();
                    }
                    $order->status = "approved";
                    $order->save();
                }
            } elseif ($type == 'point') {
                $order = PointOfSaleOrder::FindOrFail($id);
                if ($order->calc_fullFillOrder() && $order->calc_exp_date_order()) {
                    foreach ($order->PointOrderIngredients as $order_ing) {
                        $order_ing->ingredient->stock -= $order_ing->quantity;
                        $order_ing->ingredient->save();
                        $order->substactIngredentQuantity();
                    }
                    $order->status = "approved";
                    $order->save();
                }
            } elseif ($type == 'prepration') {

                $order = PreparationAreaOrder::FindOrFail($id);
                if ($order->calc_fullFillOrder() && $order->calc_exp_date_order()) {
                    foreach ($order->AreaOrderIngredients as $order_ing) {
                        $order_ing->ingredient->stock -= $order_ing->quantity;
                        $order_ing->ingredient->save();
                        $order->substactIngredentQuantity();
                    }
                    $order->status = "approved";
                    $order->save();
                }
            } else {
                return abort(401);
            }
            return back()->with('success','Order FullFilled Successfully');

    }
    //feach item data based on item selected
    public function feachItem(Request $request){
        if ($request->item) {
            $Item = Item::where('availability',1)->find($request->item);
            if ($Item)
                return json_encode($Item);
            return json_encode(['hiddenItem'=>'This item was hidden, try again later.']);

        }
        return json_encode(['empty'=>'empty']);
    }
    //change status of po from ordered to check in
    public function ChangeToCheckInStatus($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Module')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-View')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Edit')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Delete')||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Admin-Change-Password')
        ) {
            $po = PurchaseOrder::findOrFail($id);
            DB::beginTransaction();
            try {
                if ($po) {
                    $po->status_id = 3;
                    $po->arrival_date = date("Y-m-d");
                    $po->save();
                    $statusName = $po->status ? $po->status->name : '-';
                    $statusColor = $po->status ? $po->status->color : '#fff';
                    //store histoy of statues chenge of po
                    event(new ChangePOStatusEvent($po->id, $po->status_id));
                    DB::commit();
                    session()->flash('_updated', ' تم تغيير حالة الطلب بنجاح');
                    return redirect()->route('organizations.po.index');
                }
            } catch (\Exception $exception) {
                DB::rollback();
                abort(500);
            }
        }else
            return abort(401);
    }

    public function getItems(Request $request, FilterAction $filterAction)
    {
       // return $request->all();
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->where('quantity', '>', 0)
            ->take(10)->get();
        $result = view('Organization::purchaseOrders.components.items',compact('records'))->render();
        return response()->json(['result' => $result], 200);
    }

    public function getItemRow(Request $request)
    {
        $item = Ingredient::find($request->input('item'));
        $result = view('Organization::purchaseOrders.components.itemRow',compact('item'))->render();
        return response()->json(['result' => $result], 200);
    }


}
