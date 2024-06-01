<?php

namespace Organization\Http\Requests\SubscriberAttendance;

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
            'trainer_name'              => 'required|string|min:2|max:191',
            'training_name'             => 'required|string|min:2|max:191',
            'train_time'                => 'required',
            'phone'                     => 'required|string|regex:/^\+?\d+$/|unique:freelance_trainers|min:10|max:15',

        ];
    }
}
