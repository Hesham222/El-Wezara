<?php

namespace Organization\Http\Requests\FreelanceTrainer;

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
        $id = $this->route('freelanceTrainer');

        return [
            'name'              => 'required|string|min:2|max:191',
            'club_sport_id'     => 'required|exists:club_sports,id',
            'note'              => 'nullable|string|min:2',
            'phone'             => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:freelance_trainers,phone,' . $id,
            'commission'        => 'required|numeric',
            'attachment'        => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2000000',
            'national_id'       => 'required|numeric|digits:14',

        ];
    }
}
