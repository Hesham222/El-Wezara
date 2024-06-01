<?php

namespace Organization\Http\Requests\PreparationArea;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Models\Role;

class StoreRetrievalOrderRequest extends FormRequest
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
            'area_id'          => 'required','integer','exists:preparation_areas,id',
            'area'          => 'nullable','integer','exists:preparation_areas,id',
            'ingredients'             => 'required|array',
            'ingredients.*'           => 'required','integer','exists:ingredients,id',
            'quantity_after'             => 'required|array',
            'quantity_after.*'           => 'required','integer',
        ];
    }
}
