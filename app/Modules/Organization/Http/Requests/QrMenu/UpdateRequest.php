<?php

namespace Organization\Http\Requests\QrMenu;

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
            'menu'        => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'

        ];
    }
}
