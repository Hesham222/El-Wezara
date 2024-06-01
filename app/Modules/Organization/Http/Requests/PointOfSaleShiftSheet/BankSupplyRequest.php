<?php

namespace Organization\Http\Requests\PointOfSaleShiftSheet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BankSupplyRequest extends FormRequest
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
            'safe_receipt' =>['required',Rule::exists('safe_receipts','id')],
            'file' => 'required|file',
        ];
    }
}