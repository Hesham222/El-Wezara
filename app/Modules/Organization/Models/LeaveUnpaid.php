<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveUnpaid extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function Employee(){

        return $this->belongsTo(Employee::class,'employee_id');
    }

}
