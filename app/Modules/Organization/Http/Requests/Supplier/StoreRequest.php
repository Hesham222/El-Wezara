<?php

namespace Organization\Http\Requests\Supplier;

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
            'name'              => 'required|string|min:2|max:191',
            'phone'             => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:suppliers,phone',
            'speciality'        => 'nullable|string|min:2',
        ];
    }
}
