<?php

namespace Organization\Http\Requests\PreparationArea;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'                  => 'required|string|min:2|max:191',
            'employee_id'          => 'required','integer','exists:employees,id',
            'categories'          => 'required','integer','exists:menu_categories,id',
            'employees'             => 'required|array',
            'employees.*'           => 'required','integer','exists:employees,id',
        ];
    }
}
