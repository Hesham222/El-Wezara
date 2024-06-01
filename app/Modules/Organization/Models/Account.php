<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    
    use SoftDeletes ;

    protected $appends = ['debitSubAmount'];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function AccountType(){

        return $this->belongsTo(AccountType::class,'account_type_id');
    }

    public function SubAccounts()
    {
        return $this->hasMany(SubAccount::class,'account_id');
    }

    public function Debits()
    {
        return $this->hasMany(DebitSection::class,'account_id');
    }

    public function Credits()
    {
        return $this->hasMany(CreditSection::class,'account_id');
    }

    public function DebitSub()
    {
        return $this->hasManyThrough('Organization\Models\DebitSection', 'Organization\Models\SubAccount', 'account_id', 'subAccount_id');
    }

    public function getDebitSubAmountAttribute()
    {
        return $this->DebitSub()->sum('amount');
    }
}
