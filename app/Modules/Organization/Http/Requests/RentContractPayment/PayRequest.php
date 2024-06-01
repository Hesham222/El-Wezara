<?php

namespace Organization\Http\Requests\RentContractPayment;

use Illuminate\Foundation\Http\FormRequest;
use Organization\Rules\ConfirmAdminPassword;

class PayRequest extends FormRequest
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
            'resource_id'    => 'required|exists:rent_contract_payments,id',
            'payment_type'    => 'required|in:Cash,Visa',
        ];
    }
}
