<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes ;

    public function details()
    {
        return $this->belongsTo(TicketPrice::class,'ticket_price_id');
    }

    public function gate()
    {
        return $this->belongsTo(Gate::class);
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
