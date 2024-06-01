<?php

namespace Organization\Http\Requests\HotelReservation;

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
        $id = $this->route('customer');

        return [
            'hotel'                     => 'required|exists:hotels,id',
            'customer_id'               => 'required|exists:customers,id',
            'roomType_id'               => 'required|exists:room_types,id',
            'arrival_date'              => 'required|date',
            'departure_date'            => 'required|date|after:arrival_date',
            'num_of_nights'             => 'required|numeric|int|min:1',
            'room_id'                   => 'required|exists:rooms,id',
            'price_per_night'           => 'required|numeric|int|min:1',
            'total_price_for_duration'  => 'required|numeric|int|min:1',
            'num_of_children'           => 'nullable|numeric|int|min:0',
            'num_of_extra_beds'         => 'nullable|numeric|int|min:0',

        ];
    }
}
