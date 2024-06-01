<?php

namespace Organization\Models;

class LaundryHotelOrderService extends Model
{

    public function laundryOrder()
    {
        return $this->belongsTo(LaundryHotelOrder::class,);
    }

    public function laundryCategory()
    {
        return $this->belongsTo(LaundryCategory::class);
    }

    public function laundrySubCategory()
    {
        return $this->belongsTo(LaundrySubCategory::class);
    }

    public function laundryService()
    {
        return $this->belongsTo(LService::class);
    }

    public function isServiceSelected($category_id,$subCategory_id,$service_id,$order_id,$value_id){
        $service= self::where('laundry_sub_category_id',$subCategory_id)->where('laundry_category_id',$category_id)->where('laundry_service_id',$service_id)->where('laundry_hotel_order_id',$order_id)->where('id',$value_id)->first();
        if($service){
            return true;
        }
        else{
            return false;
        }
    }


}
