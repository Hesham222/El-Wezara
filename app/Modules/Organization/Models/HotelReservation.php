<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class HotelReservation extends Model
{

    use SoftDeletes ;

    protected $appends = ['amount_due','amount_future'];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function LinkedAccounts(){

        return $this->hasMany(LinkedAccount::class,'hotel_reservation_id');
    }

    public function LinkedChildren(){

        return $this->hasMany(LinkedChildren::class,'hotel_reservation_id');
    }
    public function RoomDamages(){

        return $this->hasMany(RoomDamage::class,'hotelReservation_id');
    }
    public function Customer(){

        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function RoomType(){

        return $this->belongsTo(RoomType::class,'roomType_id');
    }
    public function Room(){

        return $this->belongsTo(Rooms::class,'room_id');
    }

    public function invoices()
    {
        return $this->hasMany(HotelReservationInnvoice::class);
    }

    public function payments()
    {
        return $this->hasMany(HotelReservationPayment::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function getAmountDueAttribute()
    {
        return HotelReservationInnvoice::where('hotel_reservation_id',$this->id)->where(
            function($query) {
                return $query
                    ->where('status','System Confirmed')
                    ->orWhere('status',"Admin Confirmed");
            })->sum('amount');
    }

    public function getAmountFutureAttribute()
    {
        return HotelReservationInnvoice::where('hotel_reservation_id',$this->id)->where('status',"Not Confirmed")->sum('amount');
    }

    public function adults(){

      $reservations = HotelReservation::whereYear('created_at',date('Y'))->get();
      $sum_children = 0;
      $sum_days = 0;
      foreach ($reservations as $reservation){

          $sum_children += $reservation->num_of_children;
      }

        foreach ($reservations as $reservation){

            $sum_days += $reservation->num_of_nights;
        }
      return $sum_days - $sum_children;
    }

    public function children(){

        $reservations = HotelReservation::whereYear('created_at',date('Y'))->get();
        $sum_children = 0;
        foreach ($reservations as $reservation){

            $sum_children += $reservation->num_of_children;
        }

        return $sum_children;
    }
    public function rooms(){

        $reservations = HotelReservation::whereYear('created_at',date('Y'))->count('room_id');

        return $reservations;
    }
    public function rooms_checked(){

        $reservations = HotelReservation::whereYear('created_at',date('Y'))->where('checkIn',1)->count('room_id');

        return $reservations;
    }

    public function profits(){

        $reservations = HotelReservation::whereYear('created_at',date('Y'))->get();
        $profits = 0;
        foreach ($reservations as $reservation){

            $profits += $reservation->final_price;
        }

        return $profits;
    }
    public function revenues(){

        $reservations = HotelReservation::whereYear('created_at',date('Y'))->get();
        $revenues = 0;
        foreach ($reservations as $reservation){

            $revenues += $reservation->paidAmount;
        }

        return $revenues;
    }
    // last year
    public function last_adults(){

        $reservations = HotelReservation::whereYear('created_at',date('Y')-1)->get();
        $sum_children = 0;
        $sum_days = 0;
        foreach ($reservations as $reservation){

            $sum_children += $reservation->num_of_children;
        }

        foreach ($reservations as $reservation){

            $sum_days += $reservation->num_of_nights;
        }
        return $sum_days - $sum_children;
    }

    public function last_children(){

        $reservations = HotelReservation::whereYear('created_at',date('Y')-1)->get();
        $sum_children = 0;
        foreach ($reservations as $reservation){

            $sum_children += $reservation->num_of_children;
        }

        return $sum_children;
    }
    public function last_rooms(){

        $reservations = HotelReservation::whereYear('created_at',date('Y')-1)->count('room_id');

        return $reservations;
    }
    public function last_rooms_checked(){

        $reservations = HotelReservation::whereYear('created_at',date('Y')-1)->where('checkIn',1)->count('room_id');

        return $reservations;
    }

    public function last_profits(){

        $reservations = HotelReservation::whereYear('created_at',date('Y')-1)->get();
        $profits = 0;
        foreach ($reservations as $reservation){

            $profits += $reservation->final_price;
        }

        return $profits;
    }
    public function last_revenues(){

        $reservations = HotelReservation::whereYear('created_at',date('Y')-1)->get();
        $revenues = 0;
        foreach ($reservations as $reservation){

            $revenues += $reservation->paidAmount;
        }

        return $revenues;
    }
}
