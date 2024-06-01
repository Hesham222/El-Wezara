<?php

namespace Organization\Http\Requests\ParentRoom;

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
            'hotel'              => 'required|exists:hotels,id',
            'quantity'           => 'required|int|min:1',
            'start_room_num'     => 'required|int|min:1',
            'guestType_id'       => 'required|array',
            'guestType_id.*'     => 'required|integer','exists:room_pricings,customerType_id',
            'roomType_id'        => 'required|array',
            'roomType_id.*'      => 'required|integer','exists:room_pricings,roomType_id',
            'price'              => 'required|array',
            'price.*'            => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'guest_id'           => 'required|array',
            'guest_id.*'         => 'required|integer','exists:room_day_pricings,customerType_id',
            'room_id'            => 'required|array',
            'room_id.*'          => 'required|integer','exists:room_day_pricings,roomType_id',
            'dayPrice'           => 'required|array',
            'dayPrice.*'         => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'child_price'        => 'required|int|min:0',
            'extra_price'        => 'required|int|min:0',

        ];
    }
}
