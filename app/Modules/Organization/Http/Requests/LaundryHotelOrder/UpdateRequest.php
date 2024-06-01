<?php

namespace Organization\Http\Requests\LaundryHotelOrder;

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
//        $id = $this->route('laundry');

        return [
            'name'                          => 'required|string|min:2|max:191',
            'mobile'                        => 'required|string|regex:/^\+?\d+$/|min:10|max:15',
            'date'                          => 'required|date_format:Y-m-d',
            'total_price'                   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'laundry_id'                    => 'required',
            'hotels'                        => 'required',
            'rooms'                         => 'required',
        ];
    }
}
