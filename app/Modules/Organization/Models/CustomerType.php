<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerType extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function information(){

        return $this->hasMany(CustomerInformation::class,'customerType_id');
    }
}
