<?php

namespace Organization\Http\Requests\RoomLoss;

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
            'room'        => 'required|integer|exists:rooms,id',
            'request_date'  => 'required|date|date_format:Y-m-d',
            'customer'        => 'required|string|min:2',
            'notes'        => 'required|string|min:2',
        ];
    }
}
