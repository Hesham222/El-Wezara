<?php

namespace App\Modules\Organization\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Organization\Models\Hall;
use Organization\Models\RentContract;

class CheckStartDateRange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return  !(RentContract::select(DB::raw('1'))->whereRaw(
            ' (SELECT MIN(start_date) FROM `rent_contracts`) <= ? ' . ' AND (SELECT MAX(end_date) FROM `rent_contracts`) >= ?'
        ,[$value, $value])->exists());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is another contract in this date';
    }
}
