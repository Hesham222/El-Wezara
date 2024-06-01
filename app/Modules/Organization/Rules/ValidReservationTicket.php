<?php

namespace App\Modules\Organization\Rules;

use Illuminate\Contracts\Validation\Rule;
use Organization\Models\Reservation;

class ValidReservationTicket implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if(Reservation::where([ ['id',$value],['remaining_tickets','>',0] ])->count() > 0)
            return true;
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'التذاكر المحددة لهذا الحجز نفذت';
    }
}
