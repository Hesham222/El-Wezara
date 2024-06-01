<?php

namespace Organization\Http\Requests\Payment;

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

            'subscriber_id'                 => 'required|exists:customers,id',
            'subscription_id'               => 'required|exists:subscriptions,id',
            'payment_balance'               => 'required|numeric',
            'payment_amount'                => 'required|numeric',
            'payment_method'                => 'required|string|min:2|max:191',
        ];
    }
}
