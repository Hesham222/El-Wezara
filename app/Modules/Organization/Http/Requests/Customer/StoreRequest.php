<?php

namespace Organization\Http\Requests\Customer;

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
            'customerType_id'   => 'required|exists:customer_types,id',
            'phone'             => 'required|string|regex:/^\+?\d+$/|unique:customers|min:10|max:15',
            'email'             => 'required|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|unique:customers|max:191',
            'gender'            => 'required|string|min:2|max:191',
            'address'           => 'required|string|min:2',
            'nationality'       => 'required|string|min:2|max:191',
            'date_of_birth'     => 'required|date|date_format:Y-m-d',
        ];
    }
}
