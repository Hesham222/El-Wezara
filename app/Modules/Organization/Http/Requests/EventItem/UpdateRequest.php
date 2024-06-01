<?php

namespace Organization\Http\Requests\EventItem;

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
        return [
            'eventItemType'        => 'required|integer|exists:event_item_types,id',
            'price'       => 'required|numeric',
            'description' => 'nullable|string|min:2|max:191',
        ];
    }
}
