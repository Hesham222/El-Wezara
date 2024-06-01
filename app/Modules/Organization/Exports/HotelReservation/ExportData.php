<?php

namespace Organization\Exports\HotelReservation;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData implements FromCollection
{
    private $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        $records = $this->records;
        $data = collect([]);
        $data->push(['Id','Company','Hotel','Customer','Room Type','Arrival Date','Departure Date','Number Of Nights','Room num','Price per Night','Total price for duration','Number of Children','Number of extra beds','Final price','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                ($record->supplier) ? $record->supplier->name : "لا يوجد",
                ($record->hotel) ? $record->hotel->name : "لا يوجد",
                $record->Customer->name,
                $record->RoomType->name,
                $record->arrival_date,
                $record->departure_date,
                $record->num_of_nights,
                $record->Room->room_num,
                $record->price_per_night,
                $record->total_price_for_duration,
                $record->num_of_children,
                $record->num_of_extra_beds,
                $record->final_price,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
