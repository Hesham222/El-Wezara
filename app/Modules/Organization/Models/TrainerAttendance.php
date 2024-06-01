<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class TrainerAttendance extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function getAttendance()
    {
        return $this->attendance == '1' ? 'حضر'  : 'غائب' ;
    }

    public function FreelanceTrainer(){

        return $this->belongsTo(FreelanceTrainer::class,'freelance_trainer_id');
    }

    public function Training(){

        return $this->belongsTo(Training::class,'training_id');
    }
    public function TrainerAttendances()
    {
        return $this->hasMany(TrainerAttendance::class, 'training_id', 'training_id');
    }

    public function PricingProfit(){
        $profits = array();
        $training_ids = array();
            foreach ($this->Training->Pricings as $pricing){
                $price_of_session = $pricing->price / $pricing->num_of_sessions ;
                $profits [] = ($price_of_session * $this->Training->FreelanceTrainer->commission /100) * $this->TrainerAttendances()->count() ;
            }
            $training_ids [] =  $this->training_id;

        return $profits;
    }
}
