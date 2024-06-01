<?php

namespace Organization\Http\Requests\Reservation;

use App\Modules\Organization\Rules\reservations\amount;
use Illuminate\Foundation\Http\FormRequest;

class SupplierPaymentRequest extends FormRequest
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
            'supplier'    =>  'required|exists:vendors,id',
            'reservation_id'    =>  'required|exists:reservations,id',
            'method'            =>  'required|in:Cash,Visa',
            'paid_amount'       =>  ['required',new Amount($this->reservation_id)],
        ];
    }
}
