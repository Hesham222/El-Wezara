<?php

namespace Organization\Models;

class GateShiftSheet extends Model
{
    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }

    public function gateAdmin()
    {
        return $this->belongsTo(OrganizationAdmin::class,'organization_admin_id');
    }
}
