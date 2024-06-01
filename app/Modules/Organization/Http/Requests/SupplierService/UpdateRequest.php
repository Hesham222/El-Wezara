<?php

namespace Organization\Http\Requests\SupplierService;

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
        $id = $this->route('supplier');

        return [
            'name'              => 'required|string|min:2|max:191',
            'price'             => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'commission'        => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'description'       => 'nullable|string|min:2',
        ];
    }
}
