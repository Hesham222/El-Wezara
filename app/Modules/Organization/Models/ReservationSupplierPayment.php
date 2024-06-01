<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationSupplierPayment extends Model
{
    protected $fillable = ['supplier_id','paid_amount','reservation_id','supplier_remaining_amount','method'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }
}
