<?php

namespace Organization\Models;



class BankSupply extends Model
{
   

    public function created_by()
    {
        return $this->hasOne('Organization\Models\OrganizationAdmin', 'id','created_by');
    }

    public function safe_receipt()
    {

        return $this->belongsTo('Organization\Models\SafeReceipt', 'safe_receipt_id');

    }

}