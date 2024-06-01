<?php

namespace Organization\Http\Requests\EmployeeJob;

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
            'name' => 'required|string|min:4|max:191',
            'description' => 'nullable|string|min:4|max:300',
           // 'name_ar' => 'required|string|min:4|max:191',
           // 'description_ar' => 'nullable|string|min:4|max:300',
            'Vacation_balance' => 'required|numeric',
        ];
    }
}
