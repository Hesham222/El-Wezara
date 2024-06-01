<?php
namespace Organization\Models;

class RoomHouseKeeping extends Model
{
    protected $table = "room_house_keeping";

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}
