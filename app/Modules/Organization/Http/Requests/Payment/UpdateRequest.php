<?php

namespace Organization\Http\Requests\Payment;

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
        $id = $this->route('subscription');

        return [
            'subscriber_id'                 => 'required|exists:subscribers,id',
            'subscription_id'               => 'required|exists:subscriptions,id',
            'payment_balance'               => 'required|numeric',
            'payment_amount'                => 'required|numeric',
            'payment_method'                => 'required|string|min:2|max:191',
        ];
    }
}
