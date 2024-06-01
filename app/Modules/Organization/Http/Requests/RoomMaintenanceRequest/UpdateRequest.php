<?php

namespace Organization\Http\Requests\RoomMaintenanceRequest;

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
            'room'        => 'required|integer|exists:rooms,id',
            'notes'       => 'required|string|min:2',
            'employee'    => 'nullable|integer|exists:employees,id',
            'status'      => 'nullable|in:Pending,Accept,Reject,Out of service,Out of order',
        ];
    }
}
