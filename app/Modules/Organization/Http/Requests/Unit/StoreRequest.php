<?php

namespace Organization\Http\Requests\Unit;

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
            'name_en' => 'required|string|min:2|max:191',
            'description_en' => 'required|string|min:4|max:300',
            'name_ar' => 'required|string|min:2|max:191',
            'description_ar' => 'required|string|min:4|max:300',
        ];
    }
}
