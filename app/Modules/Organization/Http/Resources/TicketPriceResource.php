<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketPriceResource extends JsonResource
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
            'id' => $this->id,
            'subCategory' => $this->subCategory->name,
            'price' => $this->price
        ];
    }
}
