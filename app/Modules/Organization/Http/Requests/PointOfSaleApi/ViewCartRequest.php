<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Illuminate\Validation\Rule;
use Organization\Http\Requests\BaseRequest;


class ViewCartRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'point_of_sale_id'=>['nullable','exists:point_of_sales,id'],

        ];
    }

}
