<?php

namespace Organization\Http\Requests\PointOfSale;

use Illuminate\Foundation\Http\FormRequest;

class StartShiftRequest extends FormRequest
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
            'point_of_sale'    => 'required|exists:point_of_sales,id',
            'startBalance'  => 'required|numeric',
        ];
    }
}
