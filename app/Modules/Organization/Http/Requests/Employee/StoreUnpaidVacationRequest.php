<?php

namespace Organization\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnpaidVacationRequest extends FormRequest
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
            'leave_reason'    => 'required|string|min:2',
            'work_years'      => 'required|numeric|min:1',
            'leave_date'      => 'required|required|date',
            'leave_return'    => 'required|required|date',
        ];
    }
}
