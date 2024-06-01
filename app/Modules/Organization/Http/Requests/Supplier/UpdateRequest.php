<?php

namespace Organization\Http\Requests\Supplier;

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
        $id = $this->route('supplier');

        return [
            'name'              => 'required|string|min:2|max:191',
            'phone'             => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:suppliers,phone,' . $id,
            'speciality'        => 'nullable|string|min:2',
        ];
    }
}
