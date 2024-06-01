<?php

namespace Organization\Http\Requests\HotelReservation;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Rules\ConfirmAdminPassword;

class StorePaymentRequest extends FormRequest
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
            'reservation'    => 'required|exists:hotel_reservations,id',
            'method'        => 'required|in:Cash,Visa',
            'amount' => 'required|numeric',
        ];
    }
}
