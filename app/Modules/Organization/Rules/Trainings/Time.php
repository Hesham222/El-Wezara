<?php

namespace App\Modules\Organization\Rules\Trainings;

use Illuminate\Contracts\Validation\Rule;

class Time implements Rule
{
    private $start_time;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start_time)
    {
        $this->start_time = $start_time;
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
        $end   = strtotime($value);
        $start_times = $this->start_time;
        foreach ($start_times as $start_time){

            $start = strtotime($start_time);
            if($end <=  $start){
                return false;
            }else{
                return true;

            }
        }
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
