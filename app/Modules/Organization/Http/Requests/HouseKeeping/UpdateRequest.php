<?php

namespace Organization\Http\Requests\HouseKeeping;

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
            'status'      => 'nullable|in:Pending,Done,DoNotDisturb',
            'persons'     => 'nullable|int'
        ];
    }
}
