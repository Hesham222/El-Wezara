<?php

namespace Organization\Http\Requests\FreelanceTrainer;

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
            'name'              => 'required|string|min:2|max:191',
            'club_sport_id'     => 'required|exists:club_sports,id',
            'note'              => 'nullable|string|min:2',
            'phone'             => 'required|string|regex:/^\+?\d+$/|unique:freelance_trainers|min:10|max:15',
            'commission'        => 'required|numeric',
            'attachment'        => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,pptx|max:200000000',
            'national_id'       => 'required|numeric|unique:freelance_trainers|digits:14',

        ];
    }
}
