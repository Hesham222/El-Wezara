<?php

namespace Organization\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaryRequest extends FormRequest
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
                   'gross_salary' => 'required|numeric',
                'annual_increase_rate' => 'required|numeric',


            ];
    }
}
