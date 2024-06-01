<?php

namespace Organization\Http\Requests\Laundry;

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
        $id = $this->route('laundry');

        return [
            'name'              => 'required|string|min:2|max:191',
            'head_id'           => 'required|exists:employees,id',
            'description'       => 'nullable|string|min:2',
            'employee_id'       => 'nullable|array',
            'employee_id.*'     => 'nullable',
        ];
    }
}
