<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GateShift extends Model
{
    use SoftDeletes ;

    public function weekDay()
    {
        return $this->belongsTo(WeekDay::class);
    }

    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }

    public function gateShiftAdmins()
    {
        return $this->hasMany(GateShiftAdmin::class);
    }

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by')->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
}
