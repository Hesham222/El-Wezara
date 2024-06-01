<?php

namespace Organization\Http\Requests\Reservation;

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
            'booking_date'                  =>  'required|date_format:Y-m-d',
            'due_date'                      =>  'required|date_format:Y-m-d|before:booking_date',
            'from'                          =>  'required|date_format:H:i',
            'to'                            =>  'required|date_format:H:i|after:from',
            'actual_price'                  =>  'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'paid_amount'                   =>  'required|lte:actual_price|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'remaining_amount'              =>  'required|lte:actual_price|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'supplier_remaining_amount'     =>  'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'services'                      =>  'array',
            'services.*'                    =>  'integer','exists:services,id',
            'service_price'                 =>  'array',
            'service_price.*'               =>  'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'name'                          =>  'nullable|string|regex:/^[\pL\s\-]+$/u|min:4|max:191',
            'title'                         =>  'nullable|string|regex:/^[\pL\s\-]+$/u|min:4|max:191',
            'address'                       =>  'nullable|string|min:2|max:191',
            'email'                         =>  'nullable|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|unique:reservations,contact_email|max:191',
            'phone'                         =>  'nullable|string|regex:/^\+?\d+$/|unique:reservations,contact_phone|min:10|max:15',
            'national_id'                   =>  'nullable|string|regex:/^\+?\d+$/|unique:reservations,contact_national_id|digits:14',
            'customer'                    =>  'required|integer','exists:customers,id',
            'ticket_price_id'                    =>  'nullable|integer','exists:ticket_prices,id',
            'vendor'                    =>  'nullable|integer','exists:vendors,id'

        ];
    }
}
