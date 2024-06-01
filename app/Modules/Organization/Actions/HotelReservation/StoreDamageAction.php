<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\{HotelReservation, HotelReservationInnvoice, HotelReservationPayment};
use Organization\Models\RoomDamage;

class StoreDamageAction
{
    public function execute(Request $request)
    {
        $record   =  RoomDamage::create([
            'hotelReservation_id'           => $request->input('hotelReservation_id'),
            'amount'                        => $request->input('amount'),
            'damage'                        => $request->input('damage'),
            'created_by'                    => auth('organization_admin')->user()->id,
        ]);


        $reservation_invoce = new HotelReservationInnvoice();
        $reservation_invoce->hotel_reservation_id = $request->input('hotelReservation_id');
        $reservation_invoce->model_type = "RoomDamage";
        $reservation_invoce->model_id = $record->id;
        $reservation_invoce->amount = $record->amount;
        $reservation_invoce->save();

        $emp_reserve = HotelReservation::FindOrFail($request->input('hotelReservation_id'));
        // update hotel reservation
        $emp_reserve->invoicesAmount += $record->amount ;
        $emp_reserve->save();
        $emp_reserve->remainingAmount = $emp_reserve->invoicesAmount - $emp_reserve->paidAmount;
        $emp_reserve->save();

        return $record;
    }
}
