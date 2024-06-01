<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraService extends Model
{
    use SoftDeletes ;


    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }



}
