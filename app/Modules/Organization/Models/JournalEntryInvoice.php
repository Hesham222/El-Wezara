<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntryInvoice extends Model
{

    public function payment(){

        return $this->belongsTo(payment::class,'model_id');
    }

   
public function RentContractPayment(){

        return $this->belongsTo(RentContractPayment::class,'model_id');
    }

    public function HotelReservationPayment(){

        return $this->belongsTo(HotelReservationPayment::class,'model_id');
    }


    public function GateShiftSheet(){

        return $this->belongsTo(GateShiftSheet::class,'model_id');
    }
    

public function ReservationPayment(){

        return $this->belongsTo(ReservationPayment::class,'model_id');
    }

    public function LaundryOrderPayment(){

        return $this->belongsTo(LaundryOrderPayment::class,'model_id');
    }

    public function OrderPayment(){

        return $this->belongsTo(OrderPayment::class,'model_id');
    }

}