<?php

namespace Organization\Http\Requests\LaundryOrder;

use App\Modules\Organization\Rules\laundryOrders\amount;
use Illuminate\Foundation\Http\FormRequest;

class addPayment extends FormRequest
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
            'order_id'                  =>  'required',
            'date'                      => 'required|date_format:Y-m-d',
            'method'                    =>  'required',
            'paid_amount'               =>  'required',
            'paid_amount'               =>  new Amount($this->order_id),
            'remaining_amount'          =>  'required',
            'total_remaining_amount'    =>  'required',
        ];
    }
}
