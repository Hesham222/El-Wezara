<?php

namespace Organization\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class IngredientStoreRequest extends FormRequest
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
            'price'                 => 'required|numeric',
            'ingredient_id'         => 'required|exists:ingredients,id',
        ];
    }
}
