<?php

namespace Organization\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->route('admin');
        return [
            'name' => 'required|string|min:4|max:191',
            'company_name' => 'required|string|min:4|max:191',
            'tax_card' => 'required|string|min:4|max:300',
            'commercial_record' => 'required|string|min:4|max:191',
            'tax_card_attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf',
            'commercial_record_attachment' => 'nullable|mimes:jpeg,png,jpg,pdf',
        ];
    }
}
