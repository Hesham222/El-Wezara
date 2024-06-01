<?php
namespace Organization\Actions\HotelReservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\{
    HotelReservation
};
use Organization\Models\HotelReservationInnvoice;

class UpdateReservationDatesAction
{
    public function execute(Request $request,$id)
    {
        $record = HotelReservation::findOrFail($id);
        $pricePerNight = $record->price_per_night;
        $departureDate = Carbon::parse($request->input('departure_date'));

        if ($request->input('departure_date') > $record->departure_date)
        {
            $lastDate = Carbon::parse($record->invoices->where('model_type',"HotelReservation")->last()->invoice_date);
            $newDays = $lastDate->diffInDays($departureDate);
            $newAmount = 0;
            for ($i = 1 ; $i< $newDays; $i++)
            {
                $newDate = Carbon::createFromFormat('Y-m-d', $record->departure_date);
                if ($i >= 1 && $record->departure_date == $record->arrival_date)
                    $newDate = $newDate->addDays($i);
                elseif ($i > 1)
                    $newDate = $newDate->addDays($i-1);

                HotelReservationInnvoice::create([
                    'hotel_reservation_id' => $record->id,
                    'model_type'    => "HotelReservation",
                    'model_id'      => $record->id,
                    'amount'    => $pricePerNight,
                    'invoice_date'  => $newDate,
                ]);
                $newAmount = $newAmount + $pricePerNight;
            }
            $record->departure_date = $request->input('departure_date');
            $record->num_of_nights = $record->num_of_nights + ($newDays-1);
            $record->total_price_for_duration = $record->total_price_for_duration + $newAmount;
            $record->final_price = $record->final_price + $newAmount;
            $record->invoicesAmount = $record->invoicesAmount + $newAmount;
            $record->remainingAmount = $record->remainingAmount + $newAmount;
            $record->save();
        }
        elseif ($request->input('departure_date') < $record->departure_date && $request->input('departure_date') >= $record->arrival_date)
        {
            $departureDate = Carbon::createFromFormat('Y-m-d', $request->input('departure_date'));
            if ($request->input('departure_date') == $record->arrival_date)
            {
                $newLastNight = $departureDate;
                $invoices = $record->invoices->where('model_type',"HotelReservation")->where('invoice_date','>',$record->arrival_date);
            }
            else
            {
                $newLastNight = $departureDate->subDays(1);
                $invoices = $record->invoices->where('model_type',"HotelReservation")->where('invoice_date','>',$newLastNight);
            }
            $deductAmount = $invoices->sum('amount');
            $removeDays = $invoices->count();

            if ($request->input('departure_date') == $record->arrival_date)
                $record->invoices()->where('model_type',"HotelReservation")->where('invoice_date','>',$record->arrival_date)->delete();
            else
                $record->invoices()->where('model_type',"HotelReservation")->where('invoice_date','>',$newLastNight)->delete();

            $record->departure_date = $request->input('departure_date');
            $record->num_of_nights = $record->num_of_nights - $removeDays;
            $record->total_price_for_duration = $record->total_price_for_duration - $deductAmount;
            $record->final_price = $record->final_price - $deductAmount;
            $record->invoicesAmount = $record->invoicesAmount - $deductAmount;
            $record->remainingAmount = $record->remainingAmount - $deductAmount;
            $record->save();
        }
        return $record;
    }
}
