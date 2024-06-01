<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class MenuCategory extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function PreparationAreaCategories(){
        return $this->hasMany(PreparationAreaCategory::class, 'category_id','area_id');
    }

}
