<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use SoftDeletes ;

    public function packages(){
        return $this->hasMany(Package::class);
    }

    public function eventHalls()
    {
        return $this->hasMany(EventHall::class);
    }

    public function events(){
        return $this->belongsToMany(EventType::class,'event_halls','event_type_id','hall_id')->withPivot('hall_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }



    public function hallEvents()
    {

        $events_id = EventHall::where('hall_id',$this->id)->pluck('event_type_id');

        $events = EventType::whereIn('id',$events_id)->get();

        return $events;
    }

}
