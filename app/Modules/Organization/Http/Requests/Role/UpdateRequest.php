<?php

namespace Organization\Http\Requests\Role;

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
            'name'        => 'required|string|min:2|max:191',
            'permissions'    => 'nullable|array',
            'permissions.*'  => 'nullable|distinct|exists:permissions,id',
        ];
    }
}
