<?php

namespace Organization\Http\Requests\PreparationArea;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Models\Role;

class StoreManufacturedIngsRequest extends FormRequest
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
            'inventory'          => 'required','integer','exists:preparation_area_inventories,id',
            'manufactured'             => 'required|integer',
            'ingredients'             => 'required|array',
            'ingredients.*'           => 'required','integer','exists:ingredients,id',
            'manufacturedQuantity'             => 'required|array',
            'manufacturedQuantity.*'           => 'required','integer',
            'calc_cost'             => 'required|array',
            'calc_cost.*'           => 'required','integer',
            'financial_value'             => 'required|array',
            'financial_value.*'           => 'required','integer',
            'final_cost'             => 'required|array',
            'final_cost.*'           => 'required','integer',



        ];
    }
}
