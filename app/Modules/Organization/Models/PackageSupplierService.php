<?php

namespace Organization\Models;

class PackageSupplierService extends Model
{
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function supplierService()
    {
        return $this->belongsTo(SupplierService::class,'supplier_service_id');
    }

}
