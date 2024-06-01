<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Gate extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function gateShifts()
    {
        return $this->hasMany(GateShift::class);
    }
}
