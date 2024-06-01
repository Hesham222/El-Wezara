<?php

namespace Organization\Http\Requests\Hall;

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
            'minimum'              => 'required|int|min:1',
            'maximum'              => 'required|int|min:1',
            'description'       => 'nullable|string|min:2',
        ];
    }
}
