<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaundryOrderPayment extends Model
{
    protected $fillable = ['customer_name','customer_phone','paid_amount','laundry_order_id','total_remaining_amount','remaining_amount','method','date','time'];

    public function order()
    {
        return $this->belongsTo(LaundryOrder::class,'order_id');
    }
}
