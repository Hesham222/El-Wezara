<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PointOfSleResource extends JsonResource
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
            'name' => $this->name,
            'manager' => $this->manager?$this->manager->name:'-',
        ];
    }
}
