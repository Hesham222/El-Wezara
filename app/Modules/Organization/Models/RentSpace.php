<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class RentSpace extends Model
{
    use SoftDeletes ;

    protected $appends = ['rent_end_date'];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function rentContracts()
    {
        return $this->hasMany(RentContract::class,'rent_space_id');
    }

    public function getRentEndDateAttribute()
    {
        $result = $this->rentContracts->sortByDesc('end_date')->first();
        if (is_null($result) || ($result && date('Y-m-d') > $result->end_date))
            return "غير مؤجرة";

        return $result->end_date;
    }
}
