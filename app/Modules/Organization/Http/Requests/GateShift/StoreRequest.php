<?php

namespace Organization\Http\Requests\GateShift;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Rules\GateShiftAvailability;

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
            'day'        => 'required|integer|exists:week_days,id',
            'gate'       => 'required|integer|exists:gates,id',
            //'description' => 'required|string|min:2|max:191',
            'admins'           => 'required|array',
            'admins.*'         => ['required','integer','exists:organization_admins,id',new GateShiftAvailability($this->input('day'),$this->route('gateShift'),'Store')],
        ];
    }
}
