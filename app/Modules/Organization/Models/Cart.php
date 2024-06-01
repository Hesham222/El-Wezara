<?php

namespace Organization\Models;


class Cart extends Model
{
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function point_of_sale()
    {
        return $this->belongsTo(PointOfSale::class);
    }


    public function total()
    {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $itemQuantity = $item->quantity;

            if ($item->component_type == 'Ingredient'){
                $subtotal += $item->ingredent->price * $itemQuantity;
            }else{

                $subtotal += $item->item->price * $itemQuantity;

            }

        }
        $total = $subtotal;
        return $total;

    }

}
