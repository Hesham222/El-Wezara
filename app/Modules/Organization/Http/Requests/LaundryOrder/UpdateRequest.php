<?php

namespace Organization\Http\Requests\LaundryOrder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->route('laundry');
        return [
            'name'                          => 'required|string|min:2|max:191',
            'mobile'                        => 'required|string|regex:/^\+?\d+$/|min:10|max:15',
            'max_due_date'                  => 'required|date_format:Y-m-d|before:date',
            'total_price'                   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'paid_amount'                   => 'required|lte:total_price|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'remaining_amount'              => 'required|lte:total_price|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'laundry_id'                    => 'required',
            'payment_method'                => 'required'
        ];
    }
}
