<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Organization\Http\Requests\BaseRequest;


class EndSheftReqquest extends BaseRequest
{

    public function rules()
    {
        return [
            'shift'    => 'required|exists:point_of_sale_order_sheets,id',
            'endBalance'        => 'required|numeric',
        ];
    }

}
