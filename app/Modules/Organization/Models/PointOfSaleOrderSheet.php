<?php
namespace Organization\Models;

use Admin\Models\Organization;

class PointOfSaleOrderSheet extends Model
{

public function point_of_sale(){
    return $this->belongsTo(PointOfSale::class);
}

    public function orgnization_admin(){
        return $this->belongsTo(OrganizationAdmin::class,'organization_admin_id','id');
    }

}
