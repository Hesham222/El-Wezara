<?php

namespace Organization\Models;

class EventHall extends Model
{
    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

}
