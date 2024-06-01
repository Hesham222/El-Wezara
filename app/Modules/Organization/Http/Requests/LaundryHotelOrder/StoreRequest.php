<?php

namespace Organization\Http\Requests\LaundryHotelOrder;

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
            'name'                          => 'required|string|min:2|max:191',
            'mobile'                        => 'required|string|regex:/^\+?\d+$/|min:10|max:15',
            'total_price'                   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'laundry_id'                    => 'required',
            'hotels'                        => 'required',
            'rooms'                         => 'required',

        ];
    }
}
