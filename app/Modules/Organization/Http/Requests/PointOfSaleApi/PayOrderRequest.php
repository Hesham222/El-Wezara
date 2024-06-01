<?php

namespace Organization\Http\Requests\PointOfSaleApi;

use Illuminate\Validation\Rule;
use Organization\Http\Requests\BaseRequest;


class PayOrderRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'order_id'=>['nullable','exists:orders,id'],
            'point_of_sale_id'=>['nullable','exists:point_of_sales,id'],
            'point_of_sale_order_sheet_id'=>['nullable','exists:point_of_sale_order_sheets,id'],
            'payment_type'        => 'required',Rule::in(['cash', 'visa','credit','hotel','employee']),
            'room_num'    => 'nullable',Rule::exists('rooms', 'room_num')->where('status','Occupied'),
            'customer_id'    => 'nullable|exists:customers,id',
            'paidAmount'=>['nullable','numeric'],


            'discount_type'        => 'nullable',Rule::in(['value', 'percentage']),
            'discount'        => ['nullable','numeric'],
            'customer_name'=>['nullable','string'],

        ];
    }

}
