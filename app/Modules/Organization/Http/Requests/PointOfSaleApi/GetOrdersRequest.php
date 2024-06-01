<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Organization\Http\Requests\BaseRequest;


class GetOrdersRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'id'=>['nullable','numeric'],
            'point_of_sale_id'=>['nullable','exists:point_of_sales,id'],
            'type'=>['nullable','string'],
            'status'=>['nullable','string'],
        ];
    }

}
