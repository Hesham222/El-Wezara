<?php

namespace Organization\Http\Requests\Item;

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
            'name_en' => 'nullable|string|min:2|max:191',
            'description_en' => 'nullable|string|min:4|max:300',
            'name_ar' => 'required|string|min:2|max:191',
            'description_ar' => 'nullable|string|min:4|max:300',
            'type'         => 'required',
            'price'         => 'nullable|numeric',
            'image'=>'nullable|image|mimes:jpeg,png,jpg',
            'cost'         => 'required',
            'category'    => 'required|exists:menu_categories,id',
            'ingredients'           => 'required|array',
            'ingredients.*'         => 'required',
            'quantities'           => 'required|array',
            'quantities.*'         => 'required|numeric|min:0.01',
        ];
    }
}
