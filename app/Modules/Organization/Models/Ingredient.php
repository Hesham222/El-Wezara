<?php

namespace Organization\Models;



use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Ingredient extends Model
{
    use SoftDeletes ;
    use HasTranslations;
    // protected $cascadeDeletes = ['items'];
    public $translatable = ['name','description'];


    public function VendorIngredients(){

        return $this->belongsTo(VendorIngredient::class,'ingredient_id');
    }
    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function hotelOrderIngredients(){

        return $this->hasMany(HotelOrderIngredient::class,'ingredient_id');
    }
    public function AreaOrderIngredients(){

        return $this->hasMany(PreparationAreaOrderIngredient::class,'ingredient_id');
    }
    public function PointOrderIngredients(){

        return $this->hasMany(PointOfSaleOrderIngredient::class,'ingredient_id');
    }
    public function inventoryOrderIngredients(){

        return $this->hasMany(InventoryOrderIngredient::class,'ingredient_id');
    }
    public function imports()
    {


        $purshase_orders_items = PurchaseOrderItem::where('ingredient_id',$this->id)->sum('received_quantity');
        return $purshase_orders_items;

    }

    public function exports()
    {
$sum = 0;



$hotel_orders = HotelOrder::where('status','received')->get();

foreach($hotel_orders as $hotel_order)
{

foreach($hotel_order->hotelOrderIngredients as $hotelOrderIngredient){

if($hotelOrderIngredient->Ingredient->id == $this->id){
    $sum += $hotelOrderIngredient->quantity ;

}


}


}





$inv_orders = InventoryOrder::where('status','received')->get();

foreach($inv_orders as $inv_order)
{

foreach($inv_order->inventoryOrderIngredients as $inventoryOrderIngredient){

if($inventoryOrderIngredient->Ingredient->id == $this->id){
    $sum += $inventoryOrderIngredient->quantity ;

}


}


}








$pos_orders = PointOfSaleOrder::where('status','received')->get();

foreach($pos_orders as $pos_order)
{

foreach($pos_order->PointOrderIngredients as $PointOrderIngredient){

if($PointOrderIngredient->Ingredient->id == $this->id){
    $sum += $PointOrderIngredient->quantity ;

}


}


}





$prep_orders = PreparationAreaOrder::where('status','received')->get();

foreach($prep_orders as $prep_order)
{

foreach($prep_order->AreaOrderIngredients as $AreaOrderIngredient){

if($AreaOrderIngredient->Ingredient->id == $this->id){
    $sum += $AreaOrderIngredient->quantity ;

}


}


}

return $sum ;



    }



    public function unit_of_measurement()
    {
        return $this->belongsTo(UnitMeasurement::class,'unit_measurement_id','id');
    }

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class,'ingredient_category_id','id');
    }

    public function OrderIngredients(){
        return $this->hasMany(InventoryOrderIngredient::class);
    }


    public function ingredient_quantities(){
        return $this->hasMany(IngredentQuantity::class)->orderBy('expiration_date','asc');
    }


    public function ingredient_execution_quantities(){
        $currentDate = date('Y-m-d');

       // return dd($currentDate);
        return $this->hasMany(IngredentQuantity::class)->where('expiration_date','<=',$currentDate)->orderBy('expiration_date','asc');
    }

    public function manufactured()
    {
        return $this->hasMany(Ingredient::class,'ingredient_id','id');

    }


    public function outgoing()
    {

      $qty = 0;

      $holet_orders = HotelOrder::where('status','received')->get();

      foreach( $holet_orders as  $holet_order){

        foreach($holet_order->hotelOrderIngredients as $hotelOrderIngredient){

            if($hotelOrderIngredient->Ingredient->id == $this->id)
                $qty += $hotelOrderIngredient->quantity ;

        }


      }


      $inventory_orders = InventoryOrder::where('status','received')->get();

      foreach( $inventory_orders as  $inventory_order){

        foreach($inventory_order->inventoryOrderIngredients as $inventoryOrderIngredient){

            if($inventoryOrderIngredient->Ingredient->id == $this->id)
                $qty += $inventoryOrderIngredient->quantity ;

        }


      }








      $pos_orders = PointOfSaleOrder::where('status','received')->get();

      foreach( $pos_orders as  $pos_order){

        foreach($pos_order->PointOrderIngredients as $PointOrderIngredient){

            if($PointOrderIngredient->Ingredient->id == $this->id)
                $qty += $PointOrderIngredient->quantity ;

        }


      }





      $prep_orders = PreparationAreaOrder::where('status','received')->get();

      foreach( $prep_orders as  $prep_order){

        foreach($prep_order->AreaOrderIngredients as $AreaOrderIngredient){

            if($AreaOrderIngredient->Ingredient->id == $this->id)
                $qty += $AreaOrderIngredient->quantity ;

        }


      }

return $qty;


    }

    public function dataForOrders()
    {
        $ordered = 0;
        $need_to_order =0;
        $number_of_orders = 0;

        $hotel_orders = HotelOrder::with(['hotelOrderIngredients','hotel'])->where('status','pending')->get();
        $laundry_orders = InventoryOrder::with(['inventoryOrderIngredients','laundry'])->where('status','pending')->get();
        $point_of_sale_orders = PointOfSaleOrder::with(['PointOrderIngredients','PointOfSale'])->where('status','pending')->get();
        $prepration_area_orders = PreparationAreaOrder::with(['AreaOrderIngredients','area'])->where('status','pending')->get();

        foreach ($hotel_orders as $hotel_order){

            if ($hotel_order->hotelOrderIngredients->where('ingredient_id',$this->id)->first() !=null) {
                $number_of_orders+=1;
                foreach ($hotel_order->hotelOrderIngredients->where('ingredient_id',$this->id) as $ingredient){

                    $ordered+=$ingredient->stock;
                }

            }
        }


        foreach ($laundry_orders as $laundry_order){
            if ($laundry_order->inventoryOrderIngredients->where('ingredient_id',$this->id)->first()  !=null) {
                $number_of_orders+=1;
                foreach ($laundry_order->inventoryOrderIngredients->where('ingredient_id',$this->id) as $ingredient){

                    $ordered+=$ingredient->stock;
                }

            }
        }


        foreach ($point_of_sale_orders as $point_of_sale_order){
            if ($point_of_sale_order->PointOrderIngredients->where('ingredient_id',$this->id)->first()  !=null) {
                $number_of_orders+=1;
                foreach ($point_of_sale_order->PointOrderIngredients->where('ingredient_id',$this->id) as $ingredient){

                    $ordered+=$ingredient->stock;
                }

            }
        }


        foreach ($prepration_area_orders as $prepration_area_order){
            if ($prepration_area_order->AreaOrderIngredients->where('ingredient_id',$this->id)->first()  !=null) {
                $number_of_orders+=1;
                foreach ($prepration_area_order->AreaOrderIngredients->where('ingredient_id',$this->id) as $ingredient){

                    $ordered+=$ingredient->stock;
                }

            }
        }


        return [
            'id'=>$this->id,
            'ordered'=>$ordered,
            'number_of_orders'=>$number_of_orders,
            'need_to_order'=>($this->stock >= $ordered )?'--':$ordered - $this->stock
        ];

    }

    public function IngredientSumQuantity(){
        $sum_area = 0;
        $sum_hotel = 0;
        $sum_po = 0;
        $sum_laundry = 0;

        $hotel_orders = HotelOrder::where('status','received')->get();

        foreach ($hotel_orders as $hotel_order){
            foreach ($hotel_order->hotelOrderIngredients as $hotelOrderIngredient){
                if ($hotelOrderIngredient->ingredient->id == $this->id){
                    $sum_hotel += $hotelOrderIngredient->quantity ;
                }
            }
        }

        $area_orders = PreparationAreaOrder::where('status','received')->get();

        foreach ($area_orders as $area_order){
            foreach ($area_order->AreaOrderIngredients as $AreaOrderIngredient){
                if ($AreaOrderIngredient->ingredient->id == $this->id){
                    $sum_area += $AreaOrderIngredient->quantity ;
                }
            }
        }

        $po_orders = PointOfSaleOrder::where('status','received')->get();

        foreach ($po_orders as $po_order){
            foreach ($po_order->PointOrderIngredients as $PointOrderIngredient){
                if ($PointOrderIngredient->ingredient->id == $this->id){
                    $sum_po += $PointOrderIngredient->quantity;
                }
            }
        }

        $laundry_orders = InventoryOrder::where('status','received')->get();

        foreach ($laundry_orders as $laundry_order){
            foreach ($laundry_order->inventoryOrderIngredients as $inventoryOrderIngredient){
                if ($inventoryOrderIngredient->ingredient->id == $this->id){
                    $sum_laundry += $inventoryOrderIngredient->quantity ;
                }
            }
        }

        return $sum_area + $sum_hotel + $sum_po + $sum_laundry;

    }
    public function IngredientOrderTotal(){
        $sum_area = 0;
        $sum_hotel = 0;
        $sum_po = 0;
        $sum_laundry = 0;

        $hotel_orders = HotelOrder::where('status','received')->get();

        foreach ($hotel_orders as $hotel_order){
            foreach ($hotel_order->hotelOrderIngredients as $hotelOrderIngredient){
                if ($hotelOrderIngredient->ingredient->id == $this->id){
                    $sum_hotel += $hotelOrderIngredient->quantity * $hotelOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        $area_orders = PreparationAreaOrder::where('status','received')->get();

        foreach ($area_orders as $area_order){
            foreach ($area_order->AreaOrderIngredients as $AreaOrderIngredient){
                if ($AreaOrderIngredient->ingredient->id == $this->id){
                    $sum_area += $AreaOrderIngredient->quantity * $AreaOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        $po_orders = PointOfSaleOrder::where('status','received')->get();

        foreach ($po_orders as $po_order){
            foreach ($po_order->PointOrderIngredients as $PointOrderIngredient){
                if ($PointOrderIngredient->ingredient->id == $this->id){
                    $sum_po += $PointOrderIngredient->quantity * $PointOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        $laundry_orders = InventoryOrder::where('status','received')->get();

        foreach ($laundry_orders as $laundry_order){
            foreach ($laundry_order->inventoryOrderIngredients as $inventoryOrderIngredient){
                if ($inventoryOrderIngredient->ingredient->id == $this->id){
                    $sum_laundry += $inventoryOrderIngredient->quantity * $inventoryOrderIngredient->ingredient->final_cost ;
                }
            }
        }

        return $sum_area + $sum_hotel + $sum_po + $sum_laundry;

    }
}
