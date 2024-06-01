<?php

namespace Organization\Http\Requests\RentContract;

use App\Modules\Organization\Rules\CheckStartDateRange;
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
            'tenant'            => 'required|integer|exists:vendors,id',
            'rentSpace'         => 'required|integer|exists:rent_spaces,id',
            'durationType'      => 'required|in:Annually,Monthly,Weekly,Daily',
            'duration'          => 'required|integer',
            'start_date'        => ['required','date_format:Y-m-d' , new CheckStartDateRange()],
            //'end_date'        => 'required|date_format:Y-m-d|after:start_date',
            //'start_date'        => 'required|date|date_format:Y-m-d|before:end_date',
            //'end_date'          => 'required|required_with:start_date|date|date_format:Y-m-d|after:start_date',
            'paymentType'      => 'required|in:InAdvance,Afterward',
            'amount'            => 'required|numeric',
            'annualIncrease'    => 'required|numeric',
            'revenueShare'      => 'nullable|numeric',
            'notes'             => 'nullable|string|min:2',
            'attachment'        => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'

        ];
    }
}
