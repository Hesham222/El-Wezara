<?php

namespace Organization\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class CancelRequest extends FormRequest
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

            'record_id'                     => 'required|exists:subscriptions,id',
            'reason_of_cancelled'           => 'required|string|min:2',
            'attendance'                    => 'required|numeric',
            'rest_of_paid'                  => 'required|numeric',
            'attendance_price'              => 'required|numeric',
            'commission'                    => 'required|numeric',
            'amount_after_discount'         => 'required|numeric',

        ];
    }
}
