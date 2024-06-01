<?php

namespace Organization\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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
            'emp_id' => 'required|exists:employees,id',
            'overTimeDuration' => 'nullable|numeric',
            'date' => 'required|date',
            'checkIn' => 'required',
            'checkOut' => 'required',
           // 'date' => 'required',


        ];
    }
}
