<?php

namespace Organization\Http\Requests\Subscription;

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
          //  'session_balance'               => 'required|string|min:2|max:191',
           // 'payment_balance'               => 'required|numeric',
            //'subscriber_id'                 => 'required|exists:customers,id',
           // 'training_id'                   => 'required|exists:trainings,id',
           // 'price'                         => 'required|numeric',
           // 'pricing_name'                  => 'required|string|min:2|max:191',
            //'start_date'                    => 'nullable|date|date_format:Y-m-d|before:end_date',
            //'end_date'                      => 'nullable|required_with:start_date|date|date_format:Y-m-d|after:start_date',
            //'paid_date'                     => 'required|date|date_format:Y-m-d',

        ];
    }
}
