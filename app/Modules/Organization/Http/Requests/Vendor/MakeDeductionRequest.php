<?php

namespace Organization\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class MakeDeductionRequest extends FormRequest
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
            'type' => 'required',
            'po_id' => 'required',
            'value' => 'required|numeric',
        ];
    }
}