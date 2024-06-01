<?php
namespace Organization\Models;

class PoStatusHistory extends Model
{
    public function po()
    {
        return $this->belongsTo('Organization\Models\PurchaseOrder','purchase_order_id');
    }
    public function status()
    {
        return $this->belongsTo('Admin\Models\Status','status_id');
    }
    public function account_admin()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin','organization_admin_id');
    }
}
