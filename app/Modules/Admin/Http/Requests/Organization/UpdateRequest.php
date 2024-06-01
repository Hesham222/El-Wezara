<?php

namespace Admin\Http\Requests\Organization;

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
        $id = $this->route('organization');
        return [
            'name'        => 'required|string|min:2|max:191',
            'address'     => 'required|string|min:2|max:191',
            'services'    => 'nullable|array',
            'services.*'  => 'nullable|distinct|exists:services,id',
        ];
    }
}
