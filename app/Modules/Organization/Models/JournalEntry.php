<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }

    public function Debits(){

        return $this->hasMany(DebitSection::class,'journal_entry_id');
    }

    public function Credits(){

        return $this->hasMany(CreditSection::class,'journal_entry_id');
    }
}
