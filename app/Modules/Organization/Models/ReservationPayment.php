<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationPayment extends Model
{
    protected $fillable = ['paid_amount','reservation_id','remaining_amount','method'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }
}
