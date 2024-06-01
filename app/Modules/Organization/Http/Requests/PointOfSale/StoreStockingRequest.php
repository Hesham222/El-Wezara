<?php

namespace Organization\Http\Requests\PointOfSale;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockingRequest extends FormRequest
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
            'area_id'                 => 'required','integer','exists:point_of_sales,id',
            'ingredients'             => 'required|array',
            'ingredients.*'           => 'required','integer','exists:ingredients,id',
            'quantity_after'          => 'required|array',
            'quantity_after.*'        => 'required','integer',
        ];
    }
}
