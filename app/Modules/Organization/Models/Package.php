<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes ;

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function packageItems()
    {
        return $this->hasMany(PackageItem::class);
    }

    public function packageSupplierServices()
    {
        return $this->hasMany(PackageSupplierService::class,'package_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function packeage_products()
    {
        return $this->hasMany(PackageProdcut::class);
    }

}
