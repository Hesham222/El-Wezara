<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SportActivityAreas extends Model
{
    use SoftDeletes ;


    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function Trainings(){
        return $this->hasMany(Training::class,'activity_area_id');
    }
    public function ExternalPricing(){
        return $this->hasMany(ExternalPricing::class,'activity_area_id');
    }
}
