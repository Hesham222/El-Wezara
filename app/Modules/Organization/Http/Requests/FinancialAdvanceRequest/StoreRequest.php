<?php

namespace Organization\Http\Requests\FinancialAdvanceRequest;

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
            'note' => 'nullable|string|min:4|max:300',
            'date' => 'required|date',
            'amount' => 'required|numeric',
        ];
    }
}
