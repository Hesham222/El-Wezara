<?php

namespace Organization\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Organization\Http\Resources\IngredentResource;


class IngredientCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function __construct($request, $point_id=null)
    {
        parent::__construct($request);
        $this->point_id = $point_id;
    }

    public function toArray($request)
    {
        $data = [];
        foreach ($this->collection as $category) {
            array_push($data, new IngredentResource($category,$this->point_id));
        }
        return $data;
    }
}