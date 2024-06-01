<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Illuminate\Validation\Rule;
use Organization\Http\Requests\BaseRequest;


class AddItemToCartRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'Id'=>['required','integer'],
            'point_of_sale_id'=>['required','integer'],
            'type'=>['required','string'],
            'quantity'=>['required','integer'],
        ];
    }

}
