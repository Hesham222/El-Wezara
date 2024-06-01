<?php

namespace Organization\Http\Requests\PointOfSale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CloseOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id'    => 'required|exists:orders,id',
            'payment_type'        => 'required',Rule::in(['cash', 'visa','credit','hotel','employee']),
            'room_num'    => 'nullable',Rule::exists('rooms', 'room_num')->where('status','Occupied'),
            'customer_id'    => 'nullable|exists:customers,id',
        ];
    }
}
