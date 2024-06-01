<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class LService extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function LaundryServices(){
        return $this->hasMany(LaundryService::class);
    }

    public function laundrySubCategoryServices()
    {
        return $this->hasMany(LaundrySubCategoryService::class);
    }

    public function laundryOrderServices()
    {
        return $this->hasMany(LaundryOrderService::class,'laundry_service_id');
    }

}
