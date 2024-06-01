<?php

namespace Organization\Http\Requests\Account;

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
            'name'                      => 'required|string|min:2|max:191',
            'account_type_id'           => 'required|exists:account_types,id',
            'account_number'            => 'required|numeric|unique:accounts',

        ];
    }
}
