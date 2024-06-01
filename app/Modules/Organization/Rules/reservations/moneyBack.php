<?php

namespace App\Modules\Organization\Rules\reservations;

use Illuminate\Contracts\Validation\Rule;
use Organization\Models\Reservation;

class moneyBack implements Rule
{
    private $reservation_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($reservation_id)
    {
        $this->reservation_id = $reservation_id;
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
        $reservation = Reservation::find($this->reservation_id);
        $paid_amount = $reservation->paid_amount;
        if($value > $paid_amount){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'مبلغ الاسترداد يجب ان يكون مساوي للمبلغ المدفوع او أقل';
    }
}
