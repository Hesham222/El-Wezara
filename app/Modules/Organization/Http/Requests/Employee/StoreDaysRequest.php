<?php

namespace Organization\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreDaysRequest extends FormRequest
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
            'id' => 'required|exists:employees,id',
            'working_days' => 'required|numeric',
            'date' => 'required|date',


        ];
    }
}
