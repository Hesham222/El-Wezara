<?php
namespace Organization\Actions\Reservation;
use Illuminate\Http\Request;
use Organization\Models\{EventHall,
    EventType,
    Item,
    ItemVariant,
    OrderItem,
    Package,
    PackageItem,
    PackageSupplierService,
    PreparationArea,
    PreparationAreaCategory,
    Reservation,
    ReservationSupplier,
    ReservationSupplierService,
    SubscribersType,
    SupplierService};
class ConfirmAction
{
    public function execute($id)
    {
        $record                                 = Reservation::find($id);
        $record->status = "confirmed";
        $record->save();

        // send items to prep areas

        // add items to prep areas
        if (!is_null($record['package_id'])){
            $package = Package::FindOrFail($record->package_id);

            foreach ($package->packeage_products as $packeage_product){

                if ($packeage_product->component_type =="Item"){

                    $ing  = Item::FindOrFail($packeage_product->component_id);

                    $item_category_id = $ing->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                        return 0;


                    // get check this item can preperation area ings
//                $main_prep_area = PreparationArea::FindOrFail($prep_area->area_id);
//
//                if (!$main_prep_area->checkItem($ing,$packeage_product->quantity)){
//                    return 0;
//                }

                    OrderItem::create(
                        [
                            'component_type'=>'Item',
                            'component_id'=>$ing->id,
                            //'order_id' => $record->id,
                            'quantity'=>$packeage_product->quantity,
                            'amount'=>$packeage_product->price,
                            'preparation_area_id' => $prep_area->area_id,
                            'reservation_id' => $record->id,
                        ]
                    );

                }else{


                    $ing  = ItemVariant::FindOrFail($packeage_product->component_id);

                    $item_category_id = $ing->item->menu_category_id;
                    $prep_area = PreparationAreaCategory::where('category_id',$item_category_id)->first();
                    if (!$prep_area)
                        return 0;



                    // get check this item can preperation area ings
//                $main_prep_area = PreparationArea::FindOrFail($prep_area->area_id);
//
//                if (!$main_prep_area->checkItem($ing,$packeage_product->quantity)){
//                    return 0;
//                }

                    OrderItem::create(
                        [
                            'component_type'=>'Item Variant',
                            'component_id'=>$ing->id,
                            //'order_id' => $record->id,
                            'quantity'=>$packeage_product->quantity,
                            'amount'=>$packeage_product->price,
                            'preparation_area_id' => $prep_area->area_id,
                            'reservation_id' => $record->id,
                        ]
                    );

                }

            }
        }
        return 1;
    }



}
