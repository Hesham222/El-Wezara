<?php

namespace Organization\Models;

class GateShiftAdmin extends Model
{
    public function gateShift()
    {
        return $this->belongsTo(GateShift::class);
    }

    public function organizationAdmin()
    {
        return $this->belongsTo(OrganizationAdmin::class);
    }
}
