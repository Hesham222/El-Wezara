<?php

namespace App\Modules\Organization\Rules\laundryOrders;

use Illuminate\Contracts\Validation\Rule;
use Organization\Models\Hall;
use Organization\Models\LaundryOrder;
use Organization\Models\Reservation;

class amount implements Rule
{
    private $order_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
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
        $order = LaundryOrder::find($this->order_id);
        $remaining = $order->remaining_amount;
        if($value > $remaining){
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
        return 'The Paid Amount Should Be Less Than Or Equal The Remaining Amount';
    }
}
