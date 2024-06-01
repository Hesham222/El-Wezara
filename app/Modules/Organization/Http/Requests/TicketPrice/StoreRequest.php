<?php

namespace Organization\Http\Requests\TicketPrice;

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
            'category'        => 'required|integer|exists:ticket_categories,id',
            'prices' => ['required', 'array', 'min:1'],
            'prices.*' => ['string',],

        ];
    }
}
