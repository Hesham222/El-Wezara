<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Illuminate\Validation\Rule;
use Organization\Http\Requests\BaseRequest;


class AddItemToOrderRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'Id'=>['required','integer'],
            'order_id'=>['required','integer'],
            'type'=>['required','string'],
            'quantity'=>['required','integer'],
        ];
    }

}
