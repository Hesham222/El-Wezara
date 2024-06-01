<?php

namespace Organization\Http\Requests\LaundryOrder;

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

            'laundry_id'         => 'required|exists:laundries,id',
            'name'               => 'required|string|min:2|max:191',
            'mobile'             => 'required|string|regex:/^\+?\d+$/|min:10|max:15',
            'total_price'        => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'payment_method'     => 'required|string|min:2|max:191',
            'subCategories'      => 'required|array',
            'subCategories.*'    => 'required|integer','exists:laundry_sub_categories,id',
            'services'           => 'required|array',
            'services.*'         => 'required|integer','exists:l_services,id',
            'category_quantity'  => 'required|array',
            'category_quantity.*'=> 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'category_price'     => 'required|array',
            'category_price.*'   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'remaining_amount'   => 'required|lte:total_price|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ];
    }
}
