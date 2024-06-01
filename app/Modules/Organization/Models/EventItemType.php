<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class EventItemType extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function eventItems()
    {
        return $this->hasMany(EventItem::class);
    }
}
