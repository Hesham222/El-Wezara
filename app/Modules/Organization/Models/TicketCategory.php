<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function prices()
    {
        return $this->hasMany(TicketPrice::class,'ticket_category_id');
    }
}
