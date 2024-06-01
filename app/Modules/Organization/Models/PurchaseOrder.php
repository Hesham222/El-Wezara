<?php
namespace Organization\Models;

class PurchaseOrder extends Model
{


    public function items()
    {
        return $this->hasMany('Organization\Models\PurchaseOrderItem');
    }
    public function StatusHistoies()
    {
        
        return $this->hasMany('Organization\Models\PoStatusHistory');
    }

    public function payments()
    {
        return $this->hasMany(PurchaseOrderPayment::class);
    }

    public function po_deductions()
    {
        return $this->hasMany(PurchaseOrderDeduction::class);
    }

    public function status()
    {
        return $this->belongsTo('Admin\Models\Status');
    }
    public function vendor()
    {
        return $this->belongsTo('Organization\Models\Vendor');
    }


    public function add_order()
    {
        return $this->hasOne('Organization\Models\AddOrder');
    }

    public function drow_excel()
    {
        $output = '';
        foreach ($this->items as $item) {
            $output .=    'الاسم :' .' ' .  $item->item->name  .', '.
                'الكمية :'. ' ' .  $item->ordered_quantity  .' , '.
                ' وحده القياس :'.   $item->item->unit_of_measurement->name  .' ,' .
                'السعر : '.  $item->item->final_cost ;
        }
        return $output;
    }

}
