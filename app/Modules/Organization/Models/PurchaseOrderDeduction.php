<?php
namespace Organization\Models;

class PurchaseOrderDeduction extends Model
{


   

    public function po()
    {
        return $this->belongsTo('Organization\Models\PurchaseOrder');
    }
  

    public function admin()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin','created_by');
    }

}
