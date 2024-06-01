<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class EventItem extends Model
{
    use SoftDeletes ;

    public function eventItemType()
    {
        return $this->belongsTo(EventItemType::class);
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
