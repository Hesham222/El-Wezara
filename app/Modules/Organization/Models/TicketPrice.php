<?php

namespace Organization\Models;

class TicketPrice extends Model
{
    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by')->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class,'ticket_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(TicketSubCategory::class,'ticket_sub_category_id');
    }
}
