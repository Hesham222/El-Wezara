<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Organization\Http\Requests\BaseRequest;


class IncreaseItemQuantityRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'itemId'=>['nullable','exists:cart_items,id'],
            'point_of_sale_id'=>['nullable','exists:point_of_sales,id'],
        ];
    }

}
