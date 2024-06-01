<?php

namespace Organization\Http\Requests\PO;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseOrder extends FormRequest
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

            'vendor'        =>'required|exists:vendors,id',
            'status'        =>'required|exists:mysql.statues,id',
            'ReferenceNum'  =>'nullable|string|min:2|max:191',
            'orderDate'	    =>'required|date',
            'expexted'	    =>'required|date|after:orderDate',
            'shippingNote'  =>'nullable|string|min:2|max:65533',
            'generalNotes'	=>'nullable|string|min:2|max:65533',


            'bounes_quantity'  =>'nullable|numeric',
            'adding_bounes_quantity'	=>'nullable|required_with:bounes_quantity|numeric',
        ];
    }
}
