<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class LaundrySubCategory extends Model
{
    use SoftDeletes ;

    public function parent(){
        return $this->belongsTo(LaundryCategory::class,'parent_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function laundrySubCategoryServices()
    {
        return $this->hasMany(LaundrySubCategoryService::class);
    }

    public function laundaryOrderSubCategories()
    {
        return $this->hasMany(LaundryOrderSubCategory::class);
    }



}
