<?php

namespace Organization\Http\Requests\PointOfSale;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrrderRequest extends FormRequest
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
            'ingredients'           => 'required|array',
            'ingredients.*'         => 'required',
            'quantities'           => 'required|array',
            'quantities.*'         => 'required|numeric|min:0.01',
        ];
    }
}
