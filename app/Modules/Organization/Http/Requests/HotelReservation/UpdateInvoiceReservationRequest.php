<?php

namespace Organization\Http\Requests\HotelReservation;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Rules\ConfirmAdminPassword;

class UpdateInvoiceReservationRequest extends FormRequest
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
            'admin_password' => ['required', new ConfirmAdminPassword()],
            'resource_id' => 'required|exists:hotel_reservation_innvoices,id',
            'reservation_id'  => 'required|exists:hotel_reservations,id',
        ];
    }
}
