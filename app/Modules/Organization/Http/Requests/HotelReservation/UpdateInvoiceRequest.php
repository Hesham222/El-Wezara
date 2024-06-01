<?php

namespace Organization\Http\Requests\HotelReservation;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Rules\ConfirmAdminPassword;

class UpdateInvoiceRequest extends FormRequest
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
            'extraPerson'    => 'nullable|int|min:1',
            'extraKid'    => 'nullable|int|min:1',
        ];
    }
}
