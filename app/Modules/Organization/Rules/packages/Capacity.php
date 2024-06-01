<?php

namespace App\Modules\Organization\Rules\packages;

use Illuminate\Contracts\Validation\Rule;
use Organization\Models\Hall;

class Capacity implements Rule
{
    private $hall_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($hall_id)
    {
        $this->hall_id = $hall_id;
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
        $hall = Hall::find($this->hall_id);
        $max = $hall->maximum;
        $min = $hall->minimum;
        if(($value > $max) || ($value < $min)){
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
        $hall = Hall::find($this->hall_id);
        $max = $hall->maximum;
        $min = $hall->minimum;
        return 'The Capacity Must Be Between Max: '.$max.' min: '.$min;
    }
}
