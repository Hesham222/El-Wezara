<?php

namespace Organization\Models;



class SafeReceipt extends Model
{
   

    public function created_by()
    {
        return $this->hasOne('Organization\Models\OrganizationAdmin', 'id','created_by');
    }

    public function po_sheet()
    {

        return $this->belongsTo('Organization\Models\PointOfSaleOrderSheet', 'point_of_sale_order_sheet_id');

    }

}
