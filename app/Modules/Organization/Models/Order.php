<?php

namespace Organization\Models;


class Order extends Model
{
    public function admin()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin');
    }
    public function point_of_sale()
    {
        return $this->belongsTo(PointOfSale::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function order_payment()
    {
        return $this->hasOne(OrderPayment::class);
    }

     public function order_emp()
    {
        return $this->hasOne(EmployeeOrder::class);
    }
    public function order_ready()
    {

        foreach ($this->order_items as $order_item){
            if ($order_item->status == 'preparing')
                return 0;
        else
            continue;
        }

        return 1;

    }

}
