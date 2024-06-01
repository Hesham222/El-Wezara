<?php

namespace Organization\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreVriantRequest extends FormRequest
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
            'name_en' => 'nullable|string|min:4|max:191',
            'description_en' => 'nullable|string|min:4|max:300',
            'name_ar' => 'required|string|min:4|max:191',
            'description_ar' => 'nullable|string|min:4|max:300',
            'price'         => 'nullable|numeric',
            'cost'         => 'required',
            'quantities'           => 'required',
        ];
    }



    public function messages()
    {
        return [
            'quantities.required' => 'You should mark at least one ingredient as variant to add new one'
        ];
    }
}
