<?php

namespace Organization\Http\Requests\PointOfSale;

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

        return [
            'name'                  => 'required|string|min:2|max:191',
            'manager_id'            => 'required','integer','exists:employees,id',
            'items'                 => 'required|array',
            'items.*'               => 'required','integer','exists:items,id',
            'employees'             => 'required|array',
            'employees.*'           => 'required','integer','exists:employees,id',

        ];
    }
}
