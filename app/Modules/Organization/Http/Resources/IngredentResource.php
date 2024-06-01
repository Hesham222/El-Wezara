<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Organization\Models\CartItem;
use Organization\Models\Cart;

class IngredentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

 public $point_id;
    public function __construct($resource,$point_id=null)
    {
        parent::__construct($resource);
        $this->point_id = $point_id;
    }

    public function toArray($request)
    {

        $cart = cart::where('point_of_sale_id',$this->point_id)->first();

if ($cart) {
    $cart = $cart->id;
}else{
$cart = 0;

}


        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'final_cost' => $this->final_cost,
            'cost' => $this->price,
            'unit_measurement' => $this->unit_of_measurement?$this->unit_of_measurement->name:'-',
            'type'=>'Ingredient',
            'in_cart'=>(CartItem::where('cart_id',$cart)->where('component_type','Ingredient')->where('component_id',$this->id)->first())?1:0,
            'in_cart'=>(CartItem::where('cart_id',$cart)->where('component_type','Ingredient')->where('component_id',$this->id)->first())?CartItem::where('cart_id',$cart)->where('component_type','Ingredient')->where('component_id',$this->id)->first()->id:0,
        ];
    }
}
