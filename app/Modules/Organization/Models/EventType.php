<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
    use SoftDeletes ;

    public function eventHalls()
    {
        return $this->hasMany(EventHall::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

}
