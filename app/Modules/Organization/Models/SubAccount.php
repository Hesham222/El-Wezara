<?php


namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SubAccount extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function Account(){

        return $this->belongsTo(Account::class,'account_id');
    }
    public function Debits(){

        return $this->hasMany(DebitSection::class,'subAccount_id');
    }

    public function Credits(){

        return $this->hasMany(CreditSection::class,'subAccount_id');
    }
}
