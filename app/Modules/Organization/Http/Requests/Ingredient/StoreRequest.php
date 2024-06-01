<?php

namespace Organization\Http\Requests\Ingredient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name_en' => 'nullable|string|min:2|max:191',
            'description_en' => 'nullable|string|min:4|max:300',
            'name_ar' => 'required|string|min:2|max:191',
            'description_ar' => 'nullable|string|min:4|max:300',
            'quantity' => 'required|numeric',
            'stock' => 'nullable|numeric',
            're_order_quantity' => 'nullable|numeric',
            'unit'    => 'required|exists:unit_measurements,id',
            'category'    => 'required|exists:ingredient_categories,id',
            'cost' => 'required|numeric',
            'type' => 'nullable',
            Rule::in(['laundry', 'hotel','all','pointOfSale','preprationArea']),
            'ing_id'    => 'nullable|exists:ingredients,id',

        ];
    }
}
