<?php

namespace Organization\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class EndShiftRequest extends FormRequest
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
            'shift'    => 'required|exists:gate_shift_sheets,id',
            'endBalance'        => 'required|numeric',
        ];
    }
}
