<?php

namespace Organization\Http\Requests\PointOfSale;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrrderRequest extends FormRequest
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
            'point_of_sale_id'    => 'required|exists:point_of_sales,id',
            'point_of_sale_order_sheet_id'    => 'required|exists:point_of_sale_order_sheets,id',
            'ingredients'           => 'required|array',
            'ingredients.*'         => 'required',
            'quantities'           => 'required|array',
            'quantities.*'         => 'required|numeric|min:0.01',
            'table_number'         => 'nullable|numeric',
        ];
    }
}
