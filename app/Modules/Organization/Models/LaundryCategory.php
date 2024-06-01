<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class LaundryCategory extends Model
{
    use SoftDeletes ;

    public function childs(){
        return $this->hasMany(LaundrySubCategory::class,'parent_id','id');
    }
    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

}
