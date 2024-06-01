<?php

namespace Organization\Http\Requests\PO;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePOCheckInRequest extends FormRequest
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

            'shippingNote'  =>'nullable|string|min:2|max:65533',
            'bounes_quantity'  =>'nullable|numeric',
            'adding_bounes_quantity'	=>'nullable|required_with:bounes_quantity|numeric',

        ];
    }
}
