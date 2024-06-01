<?php

namespace Organization\Http\Requests\Customer;

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
        $id = $this->route('customer');

        return [
            'name'              => 'required|string|min:2|max:191',
            'customerType_id'  => 'required|exists:customer_types,id',
            'text'              => 'nullable|string|min:2',
            'phone'             => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:customers,phone,' . $id,
            'email'             => 'required|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|max:191|unique:customers,email,' . $id,
            'gender'            => 'required|string|min:2|max:191',
            'address'           => 'required|string|min:2',
            'nationality'       => 'required|string|min:2|max:191',
            'date_of_birth'     => 'required|date|date_format:Y-m-d',
            'attachment'        => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2000000',

        ];
    }
}
