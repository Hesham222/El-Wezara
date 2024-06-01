<?php

namespace Organization\Http\Requests\Ticket;

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
        return [
            'ticketPrice' => 'required|integer|exists:ticket_prices,id',
            'gate'        => 'required|integer|exists:gates,id',
            //'owner'       => 'required|integer|exists:organization_admins,id',
        ];
    }
}
