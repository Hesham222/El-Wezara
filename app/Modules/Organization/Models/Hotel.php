<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{

    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }
    public function manager(){

        return $this->belongsTo(Employee::class,'manager_id');
    }

    public function HotelInventories(){
        return $this->hasMany(HotelInventory::class, 'hotel_id');
    }

    public function ParentRooms(){
        return $this->hasMany(ParentRoom::class, 'hotel_id');
    }

    public function hotelReservations(){

        return $this->hasMany(HotelReservation::class,'hotel_id');
    }

    public function checkSupplier(){

        foreach ($this->hotelReservations as $hotelReservation){
            if($hotelReservation -> supplier_id == null){
                return "true";
            }else{
                return "false";
            }
        }
    }

    public function rooms(){

        $rooms = 0;
        $parentRooms = ParentRoom::where('hotel_id',$this->id)->get();

        foreach( $parentRooms as  $parentRoom){
            $rooms += $parentRoom->quantity;
        }

        return $rooms;
    }

}
