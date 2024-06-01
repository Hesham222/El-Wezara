<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class HotelOrder extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function hotelOrderIngredients(){
        return $this->hasMany(HotelOrderIngredient::class);
    }


    public function drow_excel()
    {
$output = '';
        foreach ($this->hotelOrderIngredients as $hotelOrderIngredient) {
       $output .=    'الاسم :' .' ' .  $hotelOrderIngredient->ingredient->name  .', '.
       'الكمية :'. ' ' .  $hotelOrderIngredient->quantity  .' , '.
      ' وحده القياس :'.   $hotelOrderIngredient->ingredient->unit_of_measurement->name  .' ,' .
      'السعر : '.  $hotelOrderIngredient->ingredient->final_cost ;
        }
return $output;
    }


public function calc_total()
{
  $total = 0 ;
    foreach($this->hotelOrderIngredients as $hotelOrderIngredient){

        $total += $hotelOrderIngredient->ingredient->final_cost ;

    }

    return $total;

}

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function calc_fullFillOrder()
    {
        if ($this->hotelOrderIngredients)
        {
            foreach ($this->hotelOrderIngredients as $order_ing)
            {

                if ($order_ing->quantity <= $order_ing->ingredient->stock){
                    continue;
                }else{return 0;}

            }

            return 1;
        }else{
            return 0;
        }

    }


    public function calc_exp_date_order()
    {
        if ($this->hotelOrderIngredients)
        {

            foreach ($this->hotelOrderIngredients as $order_ing)
            {
                $valied_exp_quantity = 0;

                foreach ($order_ing->ingredient->ingredient_quantities as $ingredient_quantity){

                    if ($ingredient_quantity->expiration_date > date('Y-m-d') ){

                        $valied_exp_quantity+=$ingredient_quantity->quantity;
                    }else{
                        continue;
                    }

                }

                if ($order_ing->quantity <= $valied_exp_quantity){
                    continue;
                }else{return 0;}

            }

            return 1;
        }else{
            return 0;
        }

    }



    public function substactIngredentQuantity()
    {

        if ($this->hotelOrderIngredients)
        {

            foreach ($this->hotelOrderIngredients as $order_ing)
            {

                $ing_order_quantity = $order_ing->quantity;
                foreach ($order_ing->ingredient->ingredient_quantities as $ingredient_quantity){


                    if ($ingredient_quantity->expiration_date > date('Y-m-d') ){

                        if ($ing_order_quantity <= $ingredient_quantity->quantity){

                            $ingredient_quantity->quantity-=$ing_order_quantity;
                            $ingredient_quantity->save();

                            $ing_order_quantity-=$order_ing->quantity;

                            if ($ingredient_quantity->quantity == 0)
                                $ingredient_quantity->delete();

                        }
                        elseif ($ing_order_quantity > $ingredient_quantity->quantity ){
                            $ing_order_quantity-=$ingredient_quantity->quantity;
                            $ingredient_quantity->delete();
                        }

                    }else{
                        continue;
                    }

                }
            }

            return 1;
        }else{
            return 0;
        }


    }

}
