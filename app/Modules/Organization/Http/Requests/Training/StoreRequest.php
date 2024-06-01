<?php

namespace Organization\Http\Requests\Training;

use App\Modules\Organization\Rules\Trainings\Time;
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
        //dd($this->start_time);
        return [
            'name'                      => 'required|string|min:2|max:191',
            'club_sport_id'             => 'required|exists:club_sports,id',
            'freelance_trainer_id'      => 'required|exists:freelance_trainers,id',
            'activity_area_id'          => 'required|exists:sport_activity_areas,id',
            'type'                      => 'required|string|min:1|max:191',
            'day'                       => 'required|array',
            'day.*'                     => 'required|string',
            'start_time'                => 'required|array',
            'start_time.*'              => 'required',
            'end_time'                  => 'required|array',
            'end_time.*'                => 'required',
            //'end_time.*'              => ['required',new Time($this->start_time)],
            //'end_time.*'                => 'required|date|after_or_equal:start_time|date_format:H:i A',
            'subscriber_type_id'        => 'required|array',
            'subscriber_type_id.*'      => 'required|integer','exists:customer_types,id',
            'pricing_name'              => 'required|array',
            'pricing_name.*'            => 'required|string',
            'num_of_sessions'           => 'required|array',
            'num_of_sessions.*'         => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'duration_in_days'          => 'nullable|array',
            'duration_in_days.*'        => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'price'                     => 'required|array',
            'price.*'                   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',


        ];
    }
}
