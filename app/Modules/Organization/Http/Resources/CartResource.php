<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'route' => 'User',
            'id' => intval($this->id),
            'items' =>  CartItemResource::collection($this->items),
            'count' => $this->items->count(),
            'total' => $this->total(),
        ];

    }
}
