<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class laundry extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function employees(){

        return $this->hasMany(LaundryEmployee::class,'laundry_id');
    }

    public function head(){

        return $this->belongsTo(Employee::class,'head_id');
    }

    public function LaundryServices(){

        return $this->hasMany(LaundryService::class);
    }
    public function LaundryInventories(){

        return $this->hasMany(LaundryInventory::class,'laundry_id');
    }

}
