<?php
namespace Organization\Models;

class PurchaseOrderPayment extends Model
{

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function admin()
    {
        return $this->belongsTo(OrganizationAdmin::class);
    }

}
