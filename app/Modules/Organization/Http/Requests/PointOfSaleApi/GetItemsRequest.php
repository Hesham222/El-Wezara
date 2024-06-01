<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Organization\Http\Requests\BaseRequest;


class GetItemsRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'keyword'=>['nullable','string'],
            'category'=>['nullable','exists:menu_categories,id'],
            'point_of_sale_id'=>['required','exists:point_of_sales,id'],
        ];
    }

}
