<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Organization\Http\Requests\BaseRequest;


class SaveOrderRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'point_of_sale_id'=>['nullable','exists:point_of_sales,id'],
            'point_of_sale_order_sheet_id'=>['nullable','exists:point_of_sale_order_sheets,id'],

        ];
    }

}
