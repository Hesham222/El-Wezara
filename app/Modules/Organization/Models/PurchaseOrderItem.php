<?php
namespace Organization\Models;

class PurchaseOrderItem extends Model
{
    public function po()
    {
        return $this->belongsTo('Organization\Models\PurchaseOrder','purchase_order_id');
    }
    public function item()
    {
        return $this->belongsTo('Organization\Models\Ingredient','ingredient_id');
    }

}
