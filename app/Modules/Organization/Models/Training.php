<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function ClubSport(){

        return $this->belongsTo(ClubSport::class,'club_sport_id');
    }
    public function FreelanceTrainer(){

        return $this->belongsTo(FreelanceTrainer::class,'freelance_trainer_id');
    }

    public function ActivityArea(){

        return $this->belongsTo(SportActivityAreas::class,'activity_area_id');
    }
    public function Subscriptions(){

        return $this->hasMany(Subscription::class,'training_id');
    }

    public function Schedules(){

        return $this->hasMany(Schedule::class,'training_id');
    }
    public function Pricings(){

        return $this->hasMany(Pricing::class,'training_id');
    }

}
