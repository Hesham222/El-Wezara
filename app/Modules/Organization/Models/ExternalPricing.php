<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ExternalPricing extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function ActivityArea(){

        return $this->belongsTo(SportActivityAreas::class,'activity_area_id');
    }
    public function Externals(){

        return $this->hasMany(External::class,'external_pricing_id');
    }
}
