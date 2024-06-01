<?php

namespace Organization\Http\Requests\Reservation;

use App\Modules\Organization\Rules\reservations\amount;
use App\Modules\Organization\Rules\reservations\moneyBack;
use Illuminate\Foundation\Http\FormRequest;

class addMoneyBackRequest extends FormRequest
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
            'reservation_id'    =>  'required|exists:reservations,id',
            //'method'            =>  'required|in:Cash,Visa',
            'money_back'       =>  ['required',new moneyBack($this->reservation_id)],
        ];
    }
}
