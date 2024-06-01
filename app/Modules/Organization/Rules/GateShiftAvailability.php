<?php

namespace Organization\Rules;

use Illuminate\Contracts\Validation\Rule;
use Organization\Models\GateShift;

class GateShiftAvailability implements Rule
{
    protected $weekDay;
    protected $gateShift;
    protected $requestType;

    public function __construct($weekDay,$gateShift,$requestType)
    {
        $this->weekDay = $weekDay;
        $this->gateShift = $gateShift;
        $this->requestType = $requestType;
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
        if ($this->requestType == "Store")
        {
            $shift = GateShift::where('week_day_id',$this->weekDay)->whereHas('gateShiftAdmins',function( $query ) use ($value) {
                $query->where('organization_admin_id',$value);
            })->first();
            if (is_null($shift))
                return true;
            else
                return false;
        }
        $shift = GateShift::where([ ['week_day_id',$this->weekDay],['id','!=',$this->gateShift] ])->whereHas('gateShiftAdmins',function( $query ) use ($value) {
            $query->where('organization_admin_id',$value);
        })->first();
        if (is_null($shift))
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
        return 'There is an admin already on a gate on this day';
    }
}
