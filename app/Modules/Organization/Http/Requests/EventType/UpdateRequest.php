<?php

namespace Organization\Http\Requests\EventType;

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
        $id = $this->route('eventType');

        return [
            'name'              => 'required|string|min:2|max:191',
            'halls'           => 'required|array',
            'halls.*'         => 'required','integer','exists:halls,id',
        ];
    }
}
