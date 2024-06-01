<?php

namespace Organization\Http\Requests\ExternalReservation;

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
            'subscriber_id'                 => 'required|exists:customers,id',
            'external_pricing_id'           => 'required|exists:external_pricings,id',
            'num_of_hours'                  => 'required|numeric',
            'date'                          => 'required|date|date_format:Y-m-d',
            'start_time'                    => 'required|string',
            'end_time'                      => 'required|string',
            'total'                         => 'required|numeric',
        ];
    }
}
