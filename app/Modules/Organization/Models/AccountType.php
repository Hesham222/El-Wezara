<?php

namespace Organization\Models;


class AccountType extends Model
{
    public function Type(){

        return $this->belongsTo(AccType::class,'acc_type_id');
    }
}
