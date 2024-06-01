<?php

namespace Organization\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreContract extends FormRequest
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

            'contract_attachments'=>'nullable|mimes:jpeg,png,jpg,pdf',


        ];


    }
}
