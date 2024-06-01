<?php

namespace Organization\Models;

class RentContractPayment extends Model
{
    public function rentContract()
    {
        return $this->belongsTo(RentContract::class);
    }
}
