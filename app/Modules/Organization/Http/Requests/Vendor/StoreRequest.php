<?php

namespace Organization\Http\Requests\Vendor;

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
            'name' => 'required|string|min:4|max:191',
            'company_name' => 'required|string|min:4|max:191',
            'tax_card' => 'required|string|min:4|max:300',
            'commercial_record' => 'required|string|min:4|max:191',
            'tax_card_attachment' => 'required|file|mimes:jpeg,png,jpg,pdf',
            'commercial_record_attachment' => 'required|mimes:jpeg,png,jpg,pdf',
        ];
    }
}
