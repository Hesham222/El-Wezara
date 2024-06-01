<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class FreelanceTrainer extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function ClubSport(){

        return $this->belongsTo(ClubSport::class,'club_sport_id');
    }
    public function Trainings(){
        return $this->hasMany(Training::class,'freelance_trainer_id');
    }
}
