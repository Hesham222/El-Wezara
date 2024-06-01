<?php

namespace Organization\Http\Requests\RoomType;

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
        $id = $this->route('roomType');

        return [
            'name'                  => 'required|string|min:2|max:191',
            'num_of_persons'        => 'required|numeric',

        ];
    }
}
