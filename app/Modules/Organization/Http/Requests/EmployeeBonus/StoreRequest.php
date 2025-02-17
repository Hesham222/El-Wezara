<?php

namespace Organization\Http\Requests\EmployeeBonus;

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
            'note' => 'nullable|string|min:4|max:300',
            'amount' => 'required|numeric',
            'attachment'=>'nullable|mimes:jpeg,png,jpg,pdf',
            'status' => 'required|string',
        ];
    }
}
