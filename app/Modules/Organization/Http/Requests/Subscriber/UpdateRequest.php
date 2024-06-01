<?php

namespace Organization\Http\Requests\Subscriber;

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
        $id = $this->route('subscriber');

        return [
            'name'                      => 'required|string|min:2|max:191',
            'subscriber_type_id'        => 'required|exists:subscribers_types,id',
            'phone'                     => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:subscribers,phone,' . $id,
            'second_phone'              => 'nullable|string|regex:/^\+?\d+$/|min:10|max:15|unique:subscribers,second_phone,' . $id,
            'attachment'                => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2000000',
            'national_id'               => 'required|numeric|digits:14|unique:subscribers,national_id,'. $id,

        ];
    }
}
