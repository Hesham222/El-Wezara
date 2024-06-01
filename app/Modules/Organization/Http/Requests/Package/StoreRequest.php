<?php

namespace Organization\Http\Requests\Package;

use App\Modules\Organization\Rules\packages\amount;
use App\Modules\Organization\Rules\packages\Capacity;
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
            'name'               => 'required|string|min:2|max:191',
            'hall'               => 'required|exists:halls,id',
//            'items'              => 'required|array',
//            'items.*'            => 'required|integer','exists:event_item_types,id',
//            'price'              => 'required|array',
//            'price.*'            => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'services'           => 'required|array',
            'services.*'         => 'required|integer','exists:services,id',
            'service_price'      => 'required|array',
            'service_price.*'    => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'capacity'           => 'required|int|min:1',
            'capacity'           => new Capacity($this->hall),
            'description'        => 'nullable|string|min:2',
            'actual_price'       => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'final_price'        => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }
}
