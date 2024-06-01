<?php

namespace Organization\Http\Requests\RoomLoss;

use Illuminate\Foundation\Http\FormRequest;

class FoundRequest extends FormRequest
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
            'found_date'  => 'required|date|date_format:Y-m-d',
            'foundBy'        => 'required|string|min:2',
        ];
    }
}
