<?php

namespace Organization\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class PointOfSale extends Model
{
    use SoftDeletes;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function PointOfSaleItems(){
        return $this->hasMany(PointOfSaleItems::class, 'PointOfSale_id');
    }

    public function PointOfSaleEmployees(){
        return $this->hasMany(PointOfSaleEmployee::class, 'PointOfSale_id');
    }
    public function PointOfSaleInventories(){
        return $this->hasMany(PointOfSaleInventory::class, 'PointOfSale_id');
    }

    public function manager(){
        return $this->belongsTo(Employee::class,'manager_id');
    }
}
