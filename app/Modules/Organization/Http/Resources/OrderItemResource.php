<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($this->component_type == 'Ingredient'){

            return [
                'id' => intval($this->id),
                'quantity' => "$this->quantity",
                'itemId' => intval($this->component_id),
                'price' => $this->ingredent ? $this->ingredent->final_cost : 0,
                'productName' => $this->ingredent ? $this->ingredent->name : 'Deleted',
                'image' =>null,
                'type' =>$this->component_type,
                'is_saved'=>($this->order->status == 'pending')?1:0,
            ];

        }else{

            return [
                'id' => intval($this->id),
                'quantity' => "$this->quantity",
                'itemId' => intval($this->component_id),
                'price' => $this->item ? $this->item->price : 0,
                'productName' => $this->item ? $this->item->name : 'Deleted',
                'image' => $this->item ? asset('storage/' . $this->item->image) : null,
                'type' =>$this->component_type,
                'is_saved'=>($this->order->status == 'pending')?1:0,
            ];
        }

    }
}
