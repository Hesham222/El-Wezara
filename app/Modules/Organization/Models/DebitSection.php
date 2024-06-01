<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DebitSection extends Model
{
    use SoftDeletes ;

    public function JournalEntry(){

        return $this->belongsTo(JournalEntry::class,'journal_entry_id');

    }
    public function Account(){

        return $this->belongsTo(Account::class,'account_id');
    }
    public function SubAccount(){

        return $this->belongsTo(SubAccount::class,'subAccount_id');
    }
}
