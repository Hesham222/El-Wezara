<?php

namespace Organization\Models;


class PreparationAreaOrder extends Model
{


    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function AreaOrderIngredients(){
        return $this->hasMany(PreparationAreaOrderIngredient::class,'inventory_order_id','id');
    }

    public function area()
    {
        return $this->belongsTo(PreparationArea::class, 'area_id');
    }




    public function drow_excel()
    {
$output = '';
        foreach ($this->AreaOrderIngredients as $AreaOrderIngredient) {
       $output .=    'الاسم :' .' ' .  $AreaOrderIngredient->ingredient->name  .', '.
       'الكمية :'. ' ' .  $AreaOrderIngredient->quantity  .' , '.
      ' وحده القياس :'.   $AreaOrderIngredient->ingredient->unit_of_measurement->name  .' ,' .
      'السعر : '.  $AreaOrderIngredient->ingredient->final_cost ;
        }
return $output;
    }


public function calc_total()
{
  $total = 0 ;
    foreach($this->AreaOrderIngredients as $AreaOrderIngredient){

        $total += $AreaOrderIngredient->ingredient->final_cost ;

    }

    return $total;

}


    public function calc_fullFillOrder()
    {
        if ($this->AreaOrderIngredients)
        {

            foreach ($this->AreaOrderIngredients as $order_ing)
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
        if ($this->AreaOrderIngredients)
        {

            foreach ($this->AreaOrderIngredients as $order_ing)
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

        if ($this->AreaOrderIngredients)
        {

            foreach ($this->AreaOrderIngredients as $order_ing)
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
