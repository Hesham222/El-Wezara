<?php
namespace Organization\Actions\PointOfSale;
use Organization\Models\Ingredient;
use Organization\Models\Item;
use Organization\Models\ItemDetail;
use Organization\Models\ItemVariant;
use Illuminate\Http\Request;
use Organization\Models\Notification;
use Organization\Models\OrderItem;
use Organization\Models\PointOfSaleInventory;
use Organization\Models\PreparationArea;
use Organization\Models\PreparationAreaCategory;

class AssignIngredientsAction
{
    public function execute(Request $request, $record)
    {

        $prep_area = null;


//        if($record->components->count())
//            ItemDetail::where('item_id',$record->id)->delete();



        if ($request->has('order_id')){



            for ($i=0;$i < count($request->ingredients);$i++)
            {
//                $is_ing = OrderItem::
//                where('order_id',$record->id)->
//                where('component_type','Ingredient')
//                    ->where('component_id',$request->ingredients[$i])->first();
//                $is_item = OrderItem::
//                where('order_id',$record->id)->
//                where('component_type','Item')
//                    ->where('component_id',$request->ingredients[$i])->first();
//
//
//                $is_variant = OrderItem::
//                where('order_id',$record->id)->
//                where('component_type','Item Variant')
//                    ->where('component_id',$request->ingredients[$i])->first();
//
//
//                if ($is_ing || $is_item || $is_variant){
//                    continue;
//                }
                $variant_ing = 0;
                $variant_item = 0;


                if ($request->comType[$i] == 1){

                    $ing  = Ingredient::FindOrFail($request->ingredients[$i]);
                    $point_of_sale_ing = PointOfSaleInventory::where('ingredient_id',$ing->id)
                    ->where('PointOfSale_id',$request->point_of_sale_id)
                    ->first();
                    if ($point_of_sale_ing){
                        if ($point_of_sale_ing->quantity < $request->quantities[$i] ){
                            return [
                                'flag'=>0,
                               // 'area_id'=>$prep_area
                            ];
                        }

                    }else{
                        return [
                            'flag'=>0,
                           // 'area_id'=>$prep_area
                        ];

                    }

                    OrderItem::create(
                        [
                            'component_type'=>'Ingredient',
                            'component_id'=>$ing->id,
                            'order_id' => $record->id,
                            'quantity'=>$request->quantities[$i],
                            'amount'=>$request->quantities[$i] * $ing->final_cost,
                            'status'=>'finished',
                        ]
                    );
                    $point_of_sale_ing->quantity -=$request->quantities[$i];
                    $point_of_sale_ing->save();
                }elseif ($request->comType[$i] == 3){


                    $ing  = ItemVariant::FindOrFail($request->ingredients[$i]);

                    $item_category_id = $ing->item->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                    return [
                        'flag'=>2,
                       // 'area_id'=>$prep_area->area_id
                    ];


                        $prep_area = $prep_area->area_id;
                        $notify = new Notification();
                        $notify->model_type = 'PreparationArea';
                        $notify->model_id = $prep_area->area_id;
                        $notify->body = 'لقد جاء طلب تحضير جديد للمنطقة';
                        $notify->save();

                    OrderItem::create(
                        [
                            'component_type'=>'Item Variant',
                            'component_id'=>$ing->id,
                            'order_id' => $record->id,
                            'quantity'=>$request->quantities[$i],
                            'amount'=>$request->quantities[$i] * $ing->price,
                            'preparation_area_id' => $prep_area->area_id,
                        ]
                    );
                }
                else{

                    $ing  = Item::FindOrFail($request->ingredients[$i]);

                    $item_category_id = $ing->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                    return [
                        'flag'=>2,
                       // 'area_id'=>$prep_area
                    ];

                        $notify = new Notification();
                        $notify->model_type = 'PreparationArea';
                        $notify->model_id = $prep_area->area_id;
                        $notify->body = 'لقد جاء طلب تحضير جديد للمنطقة';
                        $notify->save();


                        $prep_area = $prep_area->area_id;

                    OrderItem::create(
                        [
                            'component_type'=>'Item',
                            'component_id'=>$ing->id,
                            'order_id' => $record->id,
                            'quantity'=>$request->quantities[$i],
                            'amount'=>$request->quantities[$i] * $ing->price,
                            'preparation_area_id' => $prep_area->area_id,
                        ]
                    );
                }


            }

            return [
                'flag'=>1,
                'area_id'=>$prep_area
            ];







        }else{

            for ($i=0;$i < count($request->ingredients);$i++)
            {
                $variant_ing = 0;
                $variant_item = 0;


                if ($request->comType[$i] == 1){
                    $ing  = Ingredient::FindOrFail($request->ingredients[$i]);
                    $point_of_sale_ing = PointOfSaleInventory::where('ingredient_id',$ing->id)
                    ->where('PointOfSale_id',$request->point_of_sale_id)
                    ->first();
                    if ($point_of_sale_ing){
                        if ($point_of_sale_ing->quantity < $request->quantities[$i] ){
                            return [
                                'flag'=>0,
                               // 'area_id'=>$prep_area
                            ];
                        }

                    }else{  return [
                        'flag'=>0,
                       // 'area_id'=>$prep_area
                    ];
                }

                    OrderItem::create(
                        [
                            'component_type'=>'Ingredient',
                            'component_id'=>$ing->id,
                            'order_id' => $record->id,
                            'quantity'=>$request->quantities[$i],
                            'amount'=>$request->quantities[$i] * $ing->final_cost,
                            'status'=>'finished',
                        ]
                    );
                    $point_of_sale_ing->quantity -=$request->quantities[$i];
                    $point_of_sale_ing->save();
                }elseif ($request->comType[$i] == 3){
                    $ing  = ItemVariant::FindOrFail($request->ingredients[$i]);

                    $item_category_id = $ing->item->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                    return [
                        'flag'=>2,
                       // 'area_id'=>$prep_area
                    ];


                        $notify = new Notification();
                        $notify->model_type = 'PreparationArea';
                        $notify->model_id = $prep_area->area_id;
                        $notify->body = 'لقد جاء طلب تحضير جديد للمنطقة';
                        $notify->save();

                        $prep_area = $prep_area->area_id;

                    OrderItem::create(
                        [
                            'component_type'=>'Item Variant',
                            'component_id'=>$ing->id,
                            'order_id' => $record->id,
                            'quantity'=>$request->quantities[$i],
                            'amount'=>$request->quantities[$i] * $ing->price,
                            'preparation_area_id' => $prep_area->area_id,
                        ]
                    );
                }
                else{
                    $ing  = Item::FindOrFail($request->ingredients[$i]);

                    $item_category_id = $ing->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                        return [
                            'flag'=>2,
                           // 'area_id'=>$prep_area
                        ];;


                    // get check this item can preperation area ings
                    $main_prep_area = PreparationArea::FindOrFail($prep_area->area_id);

                  if (!$main_prep_area->checkItem($ing,$request->quantities[$i])){
                      return [
                        'flag'=>2,
                       // 'area_id'=>$prep_area
                    ];
                  }

                  $notify = new Notification();
                  $notify->model_type = 'PreparationArea';
                  $notify->model_id = $main_prep_area->id;
                  $notify->body = 'لقد جاء طلب تحضير جديد للمنطقة';
                  $notify->save();

                 // $prep_area = $main_prep_area->id;

                    OrderItem::create(
                        [
                            'component_type'=>'Item',
                            'component_id'=>$ing->id,
                            'order_id' => $record->id,
                            'quantity'=>$request->quantities[$i],
                            'amount'=>$request->quantities[$i] * $ing->price,
                            'preparation_area_id' => $prep_area->area_id,
                        ]
                    );
                }


            }

            return [
                'flag'=>1,
                'area_id'=>$prep_area->area_id
            ];



        }


    }
}
