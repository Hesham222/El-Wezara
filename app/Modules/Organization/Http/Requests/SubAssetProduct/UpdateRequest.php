<?php

namespace Organization\Http\Requests\SubAssetProduct;

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
        $id = $this->route('subAssetProduct');

        return [
            'name'                  => 'required|string|min:2|max:191',
            'assetProduct_id'       => 'required|exists:asset_products,id',
            'start_value'           => 'required|numeric',
            'current_value'         => 'required|numeric',
            'entry_date'            => 'required|date|date_format:Y-m-d',
        ];
    }
}
