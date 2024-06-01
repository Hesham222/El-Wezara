<?php

namespace Organization\Http\Controllers;

use Admin\Models\Organization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Organization\Http\Requests\AuthApi\LoginRequest;
use Organization\Http\Requests\checkSheetReqquest;
use Organization\Http\Requests\PointOfSaleApi\AddItemToCartRequest;
use Organization\Http\Requests\PointOfSaleApi\AddItemToOrderRequest;
use Organization\Http\Requests\PointOfSaleApi\EndSheftReqquest;
use Organization\Http\Requests\PointOfSaleApi\GetItemsRequest;
use Organization\Http\Requests\PointOfSaleApi\GetOrdersRequest;
use Organization\Http\Requests\PointOfSaleApi\IncreaseItemQuantityRequest;
use Organization\Http\Requests\PointOfSaleApi\PayOrderRequest;
use Organization\Http\Requests\PointOfSaleApi\SaveOrderRequest;
use Organization\Http\Requests\PointOfSaleApi\ViewCartRequest;
use Organization\Http\Requests\PointOfSaleApi\OrderDetailRequest;
use Organization\Http\Requests\PointOfSaleApi\OrderRemainingRequest;
use Organization\Http\Resources\CartItemResource;
use Organization\Http\Resources\CartResource;
use Organization\Http\Resources\CategoryResource;
use Organization\Http\Resources\IngredentResource;
use Organization\Http\Resources\ItemResource;
use Organization\Http\Resources\OrderResource;
use Organization\Http\Resources\OrganizationAdminResource;
use Organization\Http\Resources\PaginationResource;
use Organization\Http\Resources\PointOfSleResource;
use Organization\Http\Resources\IngredientCollection;
use Organization\Http\Resources\ItemCollection;
use Organization\Models\Cart;
use Organization\Models\CartItem;
use Organization\Models\Employee;
use Organization\Models\EmployeeOrder;
use Organization\Models\HotelReservation;
use Organization\Models\HotelReservationInnvoice;
use Organization\Models\Ingredient;
use Organization\Models\Item;
use Organization\Models\MenuCategory;
use Organization\Models\Order;
use Organization\Models\OrderItem;
use Organization\Models\OrderPayment;
use Organization\Models\PointOfSale;
use Organization\Models\PointOfSaleInventory;
use Organization\Models\PointOfSaleOrderSheet;
use Organization\Models\PreparationAreaCategory;
use Organization\Models\Rooms;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class PointOfSaleApiController extends BaseResponse
{


 public function listPointOfSales(Request $request)
 {

     $pointOfSales = PointOfSale::select(['id','name','manager_id','created_at'])->paginate(10)->appends($request->except('page'));
     return $this->response(200, 'All Point Of Sales', 200, [], 0, [
         'pointOfSales' =>  PointOfSleResource::collection($pointOfSales),
         'pagination' => new PaginationResource($pointOfSales)
     ]);

 }

 public function viewCart(ViewCartRequest $request)
 {
     $cart = Cart::where('point_of_sale_id', $request->point_of_sale_id)->first();
     if (empty($cart)) {
         return $this->response(101, 'Validation Error', 200, ['عربة التسوق فارغة']);
     }

     return $this->response(200, ' سلة المنتجات', 200, [], intval($cart->items()->count()), [
         'cart' => new CartResource($cart),
     ]);

 }

 public function deleteAllCart(ViewCartRequest $request)
 {
     $cart = Cart::where('point_of_sale_id', $request->point_of_sale_id)->first();
     $cart->delete();
     return $this->response(200, 'تم حذف جميع المنتجات من السلة بنجاح', 200);

 }


 public function checkSheet(checkSheetReqquest $reqquest)
 {

     $point_of_sale = PointOfSale::where($reqquest->point_id);
     $startShift = PointOfSaleOrderSheet::where([ ['organization_admin_id',auth('organization_admin_api')->user()->id],['shift_date',Carbon::now()->format('Y-m-d')] ])->first();

     if (is_null($startShift)){
         return $this->response(200, 'ادخل بدايه الشيت', 200,[],[
             'start_sheet'=>1,
         ]);

     }else{
         return $this->response(200, 'ادخل نهاية الشيت', 200,[],[
             'start_sheet'=>0,
             'shift_id'=>$startShift->id,
         ]);

     }
 }

 public function startSheet(checkSheetReqquest $request)
 {

     DB::beginTransaction();
     try {
         $record =  PointOfSaleOrderSheet::create([
             'organization_admin_id' => auth('organization_admin_api')->user()->id,
             'point_of_sale_id' => $request->input('point_id'),
             'shift_date' => Carbon::now()->format('Y-m-d'),
             'shift_start' => Carbon::now(),
             'start_balance' => $request->input('startBalance'),
         ]);
         DB::commit();
         return $this->response(200, 'تم فتح الشيت بنجاح', 200,[],[
             'shift_id'=>$record->id
         ]);
     }catch (\Exception $exception) {
         DB::rollback();
         return $this->response(500, $exception->getMessage(), 500);
     }

 }



    public function endSheet(EndSheftReqquest $request)
    {

        DB::beginTransaction();
        try {
            $record = PointOfSaleOrderSheet::FindOrFail($request->input('shift'));
            $orderAmount = Order::select('total_amount')->where([ ['organization_admin_id',$record->organization_admin_id],['point_of_sale_id',$record->point_of_sale_id] ])->whereDate('created_at',$record->shift_date)->sum('total_amount');
            $numberOfOrders = Order::select('id')->where([ ['organization_admin_id',$record->organization_admin_id],['point_of_sale_id',$record->point_of_sale_id] ])->whereDate('created_at',$record->shift_date)->count();

            $record->shift_end   = Carbon::now();
            $record->end_balance = $request->input('endBalance');
            $record->ordersAmount = $orderAmount;
            $record->no_of_orders = $numberOfOrders;
            $record->save();
            DB::commit();
            return $this->response(200, 'تم اغلاق الشيت بنجاح', 200);
        }catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }

    public function getItemCategory()
    {

        $categories = MenuCategory::select(['id','name'])->get();
        return $this->response(200, 'All Categories', 200, [], 0, [
            'categories' =>  CategoryResource::collection($categories),
        ]);

    }

    public function getPoItems(GetItemsRequest $request)
    {

$point_id = $request->input('point_of_sale_id');

        if ($request->has('category') && $request->input('category') !=null){

            $items = Item::

                    where('menu_category_id',$request->input('category'))
                     ->when($request->input('keyword'), function ($query) use ($request) {
                     $query->where('name->en', 'like', '%' . $request->input('keyword') . '%')

             ->orWhere('name->ar', 'like', '%' . $request->input('keyword') . '%');
              })
             ->
                select(['id', 'name','final_cost','image','cost','price','menu_category_id'])->get();



            return $this->response(200, 'المنتجات', 200,[],'',[

                'items'=>new ItemCollection($items,$point_id)
                //ItemResource::collection($items),
            ]);

        }
        elseif ($request->has('keyword') && $request->input('keyword') != '')
        {

            $ingredients = Ingredient::

            where('name->en', 'like', '%' . $request->input('keyword') . '%')
                ->orWhere('name->ar', 'like', '%' . $request->input('keyword') . '%')->
            select(['id', 'name', 'quantity','final_cost','price','unit_measurement_id','cost'])
                ->where('type','pointOfSale')
                ->where('price','!=',null)
                ->get();
            $items = Item::
            where('name->en', 'like', '%' . $request->input('keyword') . '%')
                ->orWhere('name->ar', 'like', '%' . $request->input('keyword') . '%')->
            select(['id', 'name','final_cost','image','price','cost','menu_category_id'])->get();

            return $this->response(200, 'المنتجات', 200,[],'',[
                 'ingredients'=> new IngredientCollection($ingredients,$point_id),
                //IngredentResource($point_id)->collection($ingredients),
                'items'=>new ItemCollection($items,$point_id)
                //ItemResource::collection($items),
            ]);

        }else
        {

            $ingredients = Ingredient::select(['id', 'name','price', 'quantity','final_cost','unit_measurement_id','cost'])
                ->where('type','pointOfSale')
                ->where('price','!=',null)
                ->get();
            $items = Item::select(['id', 'name','final_cost','image','price','cost','menu_category_id'])->get();


            return $this->response(200, 'المنتجات', 200,[],'',[
                'ingredients'=> new IngredientCollection($ingredients,$point_id),
                //IngredentResource($point_id)->collection($ingredients),
                'items'=>new ItemCollection($items,$point_id)
                //ItemResource::collection($items),
            ]);

        }




    }


    public function orders(GetOrdersRequest $request)
    {

        $orders = Order::where('point_of_sale_id',$request->point_of_sale_id)
            ->when($request->input('type'), function ($query) use ($request) {
                return $query->where('type',$request->type);
            })
            ->when($request->input('status'), function ($query) use ($request) {
                return $query->where('status',$request->status);
            })
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id',$request->id);
            })->paginate(10)->appends($request->except('page'));

        return $this->response(200, 'orders', 200, [], 0, [
            'orders' =>  OrderResource::collection($orders),
            'pagination' => new PaginationResource($orders)
        ]);

    }


    public function addToCart(AddItemToCartRequest $request)
    {
        DB::beginTransaction();
        try {

            $cart = Cart::where('point_of_sale_id', $request->point_of_sale_id)->first();
            if (empty($cart)) {
                $cart = Cart::create(['point_of_sale_id' => $request->point_of_sale_id]);
            }

            if ($request->type == 'Ingredient'){
                $ing = Ingredient::where('id',$request->Id)->first();
                if ($ing){

                    $is_there = CartItem::where('component_type','Ingredient')
                        ->where('component_id',$request->Id)
                           ->where('cart_id', $cart->id)
                        ->first();

                    if ($is_there)
                        return $this->response(101, 'Validation Error', 200, ['المنتج موجود فى عربة التسوق']);


                    $point_of_sale_ing = PointOfSaleInventory::where('ingredient_id',$ing->id)
                        ->where('PointOfSale_id',$request->point_of_sale_id)
                        ->first();
                    if ($point_of_sale_ing){
                        if ($point_of_sale_ing->quantity < $request->quantity ){
                            return $this->response(101, 'Validation Error', 200, ['الكمية غير متوفرة فى مخزن نقطه البيع']);

                        }

                        $cartItem = CartItem::create(['cart_id' => $cart->id, 'component_type' => $request->type,'component_id'=>$request->Id,'amount'=>0,'quantity' => $request->input('quantity')]);
                        DB::commit();
                        return $this->response(200, 'تم اضافة المنتج للسلة', 200, [], intval($cart->items()->count()), [
                            'item' => new CartItemResource($cartItem),
                            'cart' => new CartResource($cart),
                        ]);

                    }else{

                        return $this->response(101, 'Validation Error', 200, ['الكمية غير متوفرة فى مخزن نقطه البيع']);

                    }

                }


                else{
                    return $this->response(101, 'Validation Error', 200, ['لا يوجد مكون كها فى المخزن']);


                }
            }else
            {
                $ing  = Item::where('id',$request->Id)->first();

                $item_category_id = $ing->menu_category_id;
                $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                if (!$prep_area)
                    return $this->response(101, 'Validation Error', 200, ['لا يوجد منطقة تحضير لهذا المنتج']);



                $is_there = CartItem::where('component_type','Item')
                    ->where('component_id',$request->Id)
                    ->where('cart_id', $cart->id)
                    ->first();

                if ($is_there)
                    return $this->response(101, 'Validation Error', 200, ['المنتج موجود فى عربة التسوق']);


                $cartItem = CartItem::create(['cart_id' => $cart->id, 'component_type' => $request->type,'component_id'=>$request->Id,'amount'=>0,'quantity' => $request->input('quantity')]);
                DB::commit();
                return $this->response(200, 'تم اضافة المنتج للسلة', 200, [], intval($cart->items()->count()), [
                    'item' => new CartItemResource($cartItem),
                    'cart' => new CartResource($cart),
                ]);

            }

        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }


    }

    public function increaseQuantity(IncreaseItemQuantityRequest $request)
    {
        DB::beginTransaction();
        try {

            $cartItem = CartItem::where('id', $request->itemId)->whereIn('cart_id', Cart::where('point_of_sale_id', $request->point_of_sale_id)->pluck('id'))->first();
            if (!$cartItem)
                return $this->response(101, 'Validation Error', 200, ['المنتج غير موجود !']);

            $cartItem->quantity +=1;
            $cartItem->save();

            DB::commit();
            return $this->response(200, 'تم تحديث السلة بنجاح', 200, [], 0, [
                'item' => new CartItemResource($cartItem),
                'cart' => new CartResource($cartItem->cart),
            ]);

        }catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }




    public function decreaseQuantity(IncreaseItemQuantityRequest $request)
    {
        DB::beginTransaction();
        try {

            $cartItem = CartItem::where('id', $request->itemId)->whereIn('cart_id', Cart::where('point_of_sale_id', $request->point_of_sale_id)->pluck('id'))->first();
            if (!$cartItem)
                return $this->response(101, 'Validation Error', 200, ['المنتج غير موجود !']);

            $cartItem->quantity -=1;
            $cartItem->save();

            DB::commit();
            return $this->response(200, 'تم تحديث السلة بنجاح', 200, [], 0, [
                'item' => new CartItemResource($cartItem),
                'cart' => new CartResource($cartItem->cart),
            ]);

        }catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }


    public function removeItem(IncreaseItemQuantityRequest $request)
    {
        DB::beginTransaction();
        try {

            $cartItem = CartItem::where('id', $request->itemId)->whereIn('cart_id', Cart::where('point_of_sale_id', $request->point_of_sale_id)->pluck('id'))->first();
            if (!$cartItem)
                return $this->response(101, 'Validation Error', 200, ['المنتج غير موجود !']);

            $cartItem->delete();

            DB::commit();
            return $this->response(200, 'تم حذف المنتج من السلة بنجاح', 200, [], 0, [
                'item' => new CartItemResource($cartItem),
                'cart' => new CartResource($cartItem->cart),
            ]);

        }catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }

    public function saveOrder(SaveOrderRequest $request)
    {

        DB::beginTransaction();
        try {

            $cart = Cart::where('point_of_sale_id', $request->point_of_sale_id)->first();
            if (empty($cart)) {
                return $this->response(101, 'Validation Error', 200, ['لا توجد منتجات لحفظ الطلب !']);

            }else{

                if ($cart->items->count() == 0)
                    return $this->response(101, 'Validation Error', 200, ['لا توجد منتجات لحفظ الطلب !']);


            }

            $order =  Order::create([
                'organization_admin_id'                      => auth('organization_admin_api')->user()->id,
                'point_of_sale_id'               => $request->input('point_of_sale_id'),
                'point_of_sale_order_sheet_id'               => $request->input('point_of_sale_order_sheet_id'),
                'total_amount'               => $cart->total(),
                'subTotal'               => $cart->total(),
                'table_number'               => $request->input('table_number'),
                'status'               => "pending",
            ]);


            foreach ($cart->items as $cartItem)
            {
                if ($cartItem->component_type == 'Ingredient'){

                    $ing = Ingredient::where('id',$cartItem->component_id)->first();
                    if ($ing) {
                        $point_of_sale_ing = PointOfSaleInventory::where('ingredient_id', $ing->id)
                            ->where('PointOfSale_id', $request->point_of_sale_id)
                            ->first();
                        if ($point_of_sale_ing) {
                            if ($point_of_sale_ing->quantity < $cartItem->quantity) {
                                return $this->response(101, 'Validation Error', 200, ['الكمية غير متوفرة فى مخزن نقطه البيع']);

                            }
                        }

                        OrderItem::create(
                            [
                                'component_type'=>'Ingredient',
                                'component_id'=>$ing->id,
                                'order_id' => $order->id,
                                'quantity'=>$cartItem->quantity,
                                'amount'=>$cartItem->quantity * $ing->final_cost,
                                'status'=>'finished',
                            ]
                        );
                        $point_of_sale_ing->quantity -=$cartItem->quantity;
                        $point_of_sale_ing->save();


                    }

                }else
                {

                    $ing  = Item::FindOrFail($cartItem->component_id);

                    $item_category_id = $ing->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                        return $this->response(101, 'Validation Error', 200, ['لا يوجد منطقة تحضير لهذا المنتج']);

                    OrderItem::create(
                        [
                            'component_type'=>'Item',
                            'component_id'=>$ing->id,
                            'order_id' => $order->id,
                            'quantity'=>$cartItem->quantity,
                            'amount'=>$cartItem->quantity * $ing->price,
                            'preparation_area_id' => $prep_area->area_id,
                        ]
                    );


                }

            }

            $cart->delete();
            DB::commit();
            return $this->response(200, 'تم حفظ الطلب بنجاح', 200, [], 0, [
              'order_id'=>$order->id
            ]);

        }catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }


    public function addItemsToOrder(AddItemToOrderRequest $request)
    {

        DB::beginTransaction();
        try {

            $order = Order::where('id', $request->order_id)->first();
            if (empty($order)) {
                return $this->response(101, 'Validation Error', 200, ['لا يوجد طلب كهذا !']);
            }

            if ($request->type == 'Ingredient'){

                $ing = Ingredient::where('id',$request->Id)->first();
                if ($ing) {
                    $point_of_sale_ing = PointOfSaleInventory::where('ingredient_id', $ing->id)
                        ->where('PointOfSale_id', $order->point_of_sale_id)
                        ->first();
                    if ($point_of_sale_ing) {
                        if ($point_of_sale_ing->quantity < $request->quantity) {
                            return $this->response(101, 'Validation Error', 200, ['الكمية غير متوفرة فى مخزن نقطه البيع']);

                        }
                    }

                   $order_item = OrderItem::create(
                        [
                            'component_type'=>'Ingredient',
                            'component_id'=>$ing->id,
                            'order_id' => $order->id,
                            'quantity'=>$request->quantity,
                            'amount'=>$request->quantity * $ing->final_cost,
                            'status'=>'finished',
                        ]
                    );
                    $point_of_sale_ing->quantity -=$request->quantity;
                    $point_of_sale_ing->save();

                    $order->total_amount +=$order_item->amount;
                    $order->save();
                }

            }else
            {

                $ing  = Item::FindOrFail($request->Id);

                $item_category_id = $ing->menu_category_id;
                $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                if (!$prep_area)
                    return $this->response(101, 'Validation Error', 200, ['لا يوجد منطقة تحضير لهذا المنتج']);

                $order_item =   OrderItem::create(
                    [
                        'component_type'=>'Item',
                        'component_id'=>$ing->id,
                        'order_id' => $order->id,
                        'quantity'=>$request->quantity,
                        'amount'=>$request->quantity * $ing->price,
                        'preparation_area_id' => $prep_area->area_id,
                    ]
                );

                $order->total_amount +=$order_item->amount;
                $order->save();
            }
            DB::commit();
            return $this->response(200, 'تم اضافة المنتج للطلب بنجاح  ', 200, [], 0, [
                'order_id'=>$order->id
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }
    }

    public function payOrder(PayOrderRequest $request)
    {
        DB::beginTransaction();
        try {


            if ($request->order_id == null)
            {


                $cart = Cart::where('point_of_sale_id', $request->point_of_sale_id)->first();
                if (empty($cart)) {
                    return $this->response(101, 'Validation Error', 200, ['لا توجد منتجات لحفظ الطلب !']);

                }else{

                    if ($cart->items->count() == 0)
                        return $this->response(101, 'Validation Error', 200, ['لا توجد منتجات لحفظ الطلب !']);


                }

                $order =  Order::create([
                    'organization_admin_id'                      => auth('organization_admin_api')->user()->id,
                    'point_of_sale_id'               => $request->input('point_of_sale_id'),
                    'point_of_sale_order_sheet_id'               => $request->input('point_of_sale_order_sheet_id'),
                    'total_amount'               => $cart->total(),
                    'subTotal'               => $cart->total(),
                    'table_number'               => $request->input('table_number'),
                    'status'               => "sentToPrepration",
                    'type'               => $request->input('order_type'),
                ]);


                foreach ($cart->items as $cartItem)
                {
                    if ($cartItem->component_type == 'Ingredient'){

                        $ing = Ingredient::where('id',$cartItem->component_id)->first();
                        if ($ing) {
                            $point_of_sale_ing = PointOfSaleInventory::where('ingredient_id', $ing->id)
                                ->where('PointOfSale_id', $request->point_of_sale_id)
                                ->first();
                            if ($point_of_sale_ing) {
                                if ($point_of_sale_ing->quantity < $cartItem->quantity) {
                                    return $this->response(101, 'Validation Error', 200, ['الكمية غير متوفرة فى مخزن نقطه البيع']);

                                }
                            }

                            OrderItem::create(
                                [
                                    'component_type'=>'Ingredient',
                                    'component_id'=>$ing->id,
                                    'order_id' => $order->id,
                                    'quantity'=>$cartItem->quantity,
                                    'amount'=>$cartItem->quantity * $ing->final_cost,
                                    'status'=>'finished',
                                ]
                            );
                            $point_of_sale_ing->quantity -=$cartItem->quantity;
                            $point_of_sale_ing->save();


                        }

                    }else
                    {

                        $ing  = Item::FindOrFail($cartItem->component_id);

                        $item_category_id = $ing->menu_category_id;
                        $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                        if (!$prep_area)
                            return $this->response(101, 'Validation Error', 200, ['لا يوجد منطقة تحضير لهذا المنتج']);

                        OrderItem::create(
                            [
                                'component_type'=>'Item',
                                'component_id'=>$ing->id,
                                'order_id' => $order->id,
                                'quantity'=>$cartItem->quantity,
                                'amount'=>$cartItem->quantity * $ing->price,
                                'preparation_area_id' => $prep_area->area_id,
                            ]
                        );


                    }

                }

                $cart->delete();


                if ($request->payment_type == "cash" || $request->payment_type == "visa" || $request->payment_type == "credit")
                {
                    $tax = 0;//$order->total_amount * .12 ;
                    $order->total_amount = $order->total_amount + $tax ;
                    $order->status = "closed";

                    if (!$request->has('paidAmount'))
                        return $this->response(101, 'Validation Error', 200, ['الرجاء ادخال المبلغ المدفوع']);

                    if ($request->input('paidAmount') == null)
                        return $this->response(101, 'Validation Error', 200, ['الرجاء ادخال المبلغ المدفوع']);


                    if ( ($request->input('paidAmount') > $order->total_amount) || ($request->input('paidAmount') == $order->total_amount) )
                    {
                        $order->paidAmount = $request->input('paidAmount') ;
                        $order->remainingAmount = 0;

                    }else
                    {
                        $order->paidAmount =  $request->input('paidAmount') ;
                        $order->remainingAmount = $order->total_amount -  $request->input('paidAmount');

                    }

                    $order->save();
                    // add order payment type
                    $order_payment = new OrderPayment();
                    $order_payment->order_id = $order->id;
                    $order_payment->type = $request->payment_type;
                    $order_payment->amount = $order->total_amount;
                    $order_payment->save();
                }
                elseif ($request->payment_type == "employee")
                {
                    $emp = Employee::FindOrFail($request->employee);
                    $order->status = "closed";
                    $order->save();
                    // add order to emp orders table
                    $emp_order = new EmployeeOrder();
                    $emp_order->employee_id = $emp->id;
                    $emp_order->order_id = $order->id;
                    $emp_order->save();

                    // add order payment type
                    $order_payment = new OrderPayment();
                    $order_payment->order_id = $order->id;
                    $order_payment->type = $request->payment_type;
                    $order_payment->amount = $order->total_amount;
                    $order_payment->save();

                }
                elseif ($request->payment_type == "hotel")
                {
                    // check if emp  reserve this room
                    $emp_reserve = HotelReservation::where('customer_id',$request->customer_id)
                        ->where('room_id',Rooms::where('room_num',$request->room_num)->first()->id)->first();
                    if (!$emp_reserve){
                        return $this->response(101, 'Validation Error', 200, ['الغرفة غير متاحه لاستقبال الطلب!']);

                    }
                    $order->status = "closed";
                    $order->save();

                    $reservation_invoce = new HotelReservationInnvoice();
                    $reservation_invoce->hotel_reservation_id = $emp_reserve->id;
                    $reservation_invoce->model_type = "Order";
                    $reservation_invoce->model_id = $order->id;
                    $reservation_invoce->amount = $order->total_amount;
                    $reservation_invoce->save();

                    // update hotel reservation
                    $emp_reserve->invoicesAmount += $order->total_amount ;
                    $emp_reserve->save();
                    $emp_reserve->remainingAmount = $emp_reserve->invoicesAmount - $emp_reserve->paidAmount;
                    $emp_reserve->save();


                    // add order payment type
                    $order_payment = new OrderPayment();
                    $order_payment->order_id = $order->id;
                    $order_payment->type = $request->payment_type;
                    $order_payment->amount = $order->total_amount;
                    $order_payment->save();

                    //hotel reservation add amount
                    $emp_reserve->invoicesAmount = $emp_reserve->invoicesAmount + $order->total_amount;
                    $emp_reserve->save();
                }



                if($request->has('discount_type') && $request->input('discount_type') != null){

                    if($request->input('discount_type') == 'percentage'){

                        if($request->input('discount') > 100)
                        return $this->response(101, 'Validation Error', 200, ['    يجب الا تتعدى النسبة 100%!']);

                        $desc = $order->total * $request->input('discount') / 100;

                        $order->total_amount -= $desc;
                        $order->customer_name = $request->input('customer_name');
                        $order->discount_type = $request->input('discount_type');
                        $order->discount = $request->input('discount');
                        $order->save();

                    }else
                    {
                        $desc =$request->input('discount');

                        $order->total_amount -= $desc;
                        $order->customer_name = $request->input('customer_name');
                        $order->discount_type = $request->input('discount_type');
                        $order->discount = $request->input('discount');
                        $order->save();

                    }

                }
                DB::commit();


                return $this->response(200, 'تم دفع الطلب بنجاح', 200, [], 0, [
                    'order_id'=>$order->id,
                    'items'=>new OrderResource($order)
                ]);


            }else
            {

                $order = Order::where('id',$request->order_id)->first();

                if ($request->payment_type == "cash" || $request->payment_type == "visa" || $request->payment_type == "credit")
                {
                    $tax = 0;//$order->total_amount * .12 ;
                    $order->total_amount = $order->total_amount + $tax ;
                    $order->status = "closed";


                    if (!$request->has('paidAmount'))
                        return $this->response(101, 'Validation Error', 200, ['الرجاء ادخال المبلغ المدفوع']);

                    if ($request->input('paidAmount') == null)
                        return $this->response(101, 'Validation Error', 200, ['الرجاء ادخال المبلغ المدفوع']);


                    if ( ($request->input('paidAmount') > $order->total_amount) || ($request->input('paidAmount') == $order->total_amount) )
                    {
                        $order->paidAmount = $request->input('paidAmount') ;
                        $order->remainingAmount = 0;

                    }else
                    {
                        $order->paidAmount =  $request->input('paidAmount') ;
                        $order->remainingAmount = $order->total_amount -  $request->input('paidAmount');

                    }

                    $order->save();
                    // add order payment type
                    $order_payment = new OrderPayment();
                    $order_payment->order_id = $order->id;
                    $order_payment->type = $request->payment_type;
                    $order_payment->amount = $order->total_amount;
                    $order_payment->save();
                }
                elseif ($request->payment_type == "employee")
                {
                    $emp = Employee::FindOrFail($request->employee);
                    $order->status = "closed";
                    $order->save();
                    // add order to emp orders table
                    $emp_order = new EmployeeOrder();
                    $emp_order->employee_id = $emp->id;
                    $emp_order->order_id = $order->id;
                    $emp_order->save();

                    // add order payment type
                    $order_payment = new OrderPayment();
                    $order_payment->order_id = $order->id;
                    $order_payment->type = $request->payment_type;
                    $order_payment->amount = $order->total_amount;
                    $order_payment->save();

                }
                elseif ($request->payment_type == "hotel")
                {
                    // check if emp  reserve this room
                    $emp_reserve = HotelReservation::where('customer_id',$request->customer_id)
                        ->where('room_id',Rooms::where('room_num',$request->room_num)->first()->id)->first();
                    if (!$emp_reserve){
                        return $this->response(101, 'Validation Error', 200, ['الغرفة غير متاحه لاستقبال الطلب!']);

                    }
                    $order->status = "closed";
                    $order->save();

                    $reservation_invoce = new HotelReservationInnvoice();
                    $reservation_invoce->hotel_reservation_id = $emp_reserve->id;
                    $reservation_invoce->model_type = "Order";
                    $reservation_invoce->model_id = $order->id;
                    $reservation_invoce->amount = $order->total_amount;
                    $reservation_invoce->save();

                    // update hotel reservation
                    $emp_reserve->invoicesAmount += $order->total_amount ;
                    $emp_reserve->save();
                    $emp_reserve->remainingAmount = $emp_reserve->invoicesAmount - $emp_reserve->paidAmount;
                    $emp_reserve->save();


                    // add order payment type
                    $order_payment = new OrderPayment();
                    $order_payment->order_id = $order->id;
                    $order_payment->type = $request->payment_type;
                    $order_payment->amount = $order->total_amount;
                    $order_payment->save();

                    //hotel reservation add amount
                    $emp_reserve->invoicesAmount = $emp_reserve->invoicesAmount + $order->total_amount;
                    $emp_reserve->save();
                }




                if($request->has('discount_type') && $request->input('discount_type') != null){

                    if($request->input('discount_type') == 'percentage'){

                        if($request->input('discount') > 100)
                        return $this->response(101, 'Validation Error', 200, ['    يجب الا تتعدى النسبة 100%!']);

                        $desc = $order->total * $request->input('discount') / 100;

                        $order->total_amount -= $desc;
                        $order->customer_name = $request->input('customer_name');
                        $order->discount_type = $request->input('discount_type');
                        $order->discount = $request->input('discount');
                        $order->save();

                    }else
                    {
                        $desc =$request->input('discount');

                        $order->total_amount -= $desc;
                        $order->customer_name = $request->input('customer_name');
                        $order->discount_type = $request->input('discount_type');
                        $order->discount = $request->input('discount');
                        $order->save();

                    }

                }
                DB::commit();


                return $this->response(200, 'تم دفع الطلب بنجاح', 200, [], 0, [
                    'order_id'=>$order->id,
                    'items'=>new OrderResource($order)
                ]);


            }

        }
        catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }

    public function orderDetail(OrderDetailRequest $request)
    {

       DB::beginTransaction();
        try {


                $order = Order::where('id',$request->order_id)->first();
            DB::commit();
            return $this->response(200, 'order details', 200, [], 0, [
                'order' => new OrderResource($order),

            ]);

        }catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }


public function payRemaining(OrderRemainingRequest $request)
{

       DB::beginTransaction();
//        try {


                $order = Order::where('id',$request->order_id)->first();

if ($request->amount < $order->remainingAmount) {
    // code...
$order->remainingAmount = $order->remainingAmount - $request->amount ;
$order->paidAmount +=$request->amount;

}else{

   $order->remainingAmount = 0;
   $order->paidAmount +=$request->amount;
}
$order->save();

            DB::commit();
            return $this->response(200, 'order details', 200, [], 0, [
                'order' => new OrderResource($order),

            ]);

//        }catch (\Exception $exception) {
            DB::rollback();
//            return $this->response(500, $exception->getMessage(), 500);
//        }

}

}
