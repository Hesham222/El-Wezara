<?php

namespace Organization\Http\Requests\Subscriber;

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
            'name'                      => 'required|string|min:2|max:191',
            'subscriber_type_id'        => 'required|exists:subscribers_types,id',
            'phone'                     => 'required|string|regex:/^\+?\d+$/|unique:subscribers|min:10|max:15',
            'second_phone'              => 'nullable|string|regex:/^\+?\d+$/|unique:subscribers|min:10|max:15',
            'attachment'                => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2000000',
            'national_id'               => 'required|numeric|unique:subscribers|digits:14',

        ];
    }
}
