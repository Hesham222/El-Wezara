<?php

namespace Organization\Http\Requests\Reservation;

use App\Modules\Organization\Rules\reservations\amount;
use App\Modules\Organization\Rules\reservations\supplierAmount;
use Illuminate\Foundation\Http\FormRequest;

class addSupplierPayment extends FormRequest
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
            'supplier'    =>  'required|exists:suppliers,id',
            'reservation_id'    =>  'required|exists:reservations,id',
            'method'            =>  'required|in:Cash,Visa',
            'paid_amount'       =>  ['required',new Amount($this->reservation_id)],
        ];
    }
}
