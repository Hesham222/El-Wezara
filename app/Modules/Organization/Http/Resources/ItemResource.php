<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Organization\Models\CartItem;
use Organization\Models\Cart;


class ItemResource extends JsonResource
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
            'final_cost' => $this->quantity,
            'cost' => $this->price,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'menu_category_id'=>$this->menu_category_id,
            'type'=>'Item',
            'in_cart'=>(CartItem::where('cart_id',$cart)->where('component_type','Item')->where('component_id',$this->id)->first())?1:0,
            'item_id'=>(CartItem::where('cart_id',$cart)->where('component_type','Item')->where('component_id',$this->id)->first())?CartItem::where('cart_id',$cart)->where('component_type','Item')->where('component_id',$this->id)->first()->id:0,
        ];
    }
}
