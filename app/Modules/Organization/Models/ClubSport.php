<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class ClubSport extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function freelanceTrainings(){
        return $this->hasMany(FreelanceTrainer::class,'club_sport_id');
    }
    public function Trainings(){
        return $this->hasMany(Training::class,'club_sport_id');
    }
}
