<?php

namespace Organization\Http\Requests\LaundryService;

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
            'name'              => 'required|string|min:2|max:191',
            'laundries'           => 'required|array',
            'laundries.*'         => 'required','integer','exists:l_services,id',

        ];
    }
}
