<?php

namespace Organization\Http\Requests\Ticket;

use App\Modules\Organization\Rules\ValidReservationTicket;
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
            'ticketPrice' => 'nullable|integer|exists:ticket_prices,id',
            'gate'        => 'required|integer|exists:gates,id',
            'owner'       => 'required|integer|exists:organization_admins,id',
            'reservation'   => ['nullable','integer','exists:reservations,id',new ValidReservationTicket()],
        ];
    }
}
