<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DailyAccount extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function JournalEntry(){

        return $this->belongsTo(JournalEntry::class,'journal_entry_id');
    }


}
