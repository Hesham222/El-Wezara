<?php

namespace Organization\Rules;

use Illuminate\Contracts\Validation\Rule;
use Organization\Models\RentSpace;

class GetRentContractAvailability implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $space;

    public function __construct($space)
    {
        $this->space = $space;
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
        if(
            RentSpace::where('id', $this->space->id)->first()

        )
            return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
