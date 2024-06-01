<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Illuminate\Validation\Rule;
use Organization\Http\Requests\BaseRequest;


class OrderRemainingRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'order_id'=>['nullable','exists:orders,id'],
            'amount'=>['nullable','numeric'],
        ];
    }

}