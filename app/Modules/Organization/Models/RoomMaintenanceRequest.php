<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RoomMaintenanceRequest extends Model
{
    
    use SoftDeletes ;

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by')->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function employee()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'employee_id')->withTrashed();
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}
