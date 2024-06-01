<?php

namespace Organization\Exports\HotelWork;

use Maatwebsite\Excel\Concerns\FromCollection;

class HotelWorkWeeklyExportData implements FromCollection
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
        $data->push($records);
        foreach ($records as $record) {
            $data->push([
               'Arrival : ' . \Organization\Models\HotelReservation::where('arrival_date',$record)->count() . ' ,'
               .'Departure : '. \Organization\Models\HotelReservation::where('departure_date',$record)->count() . ' , '
               .'Stay Over : '. \Organization\Models\HotelReservation::where('arrival_date','<=',$record)->where('departure_date','>=',$record)->count() . ' ,'
            ]);
        }
        return $data;
    }
}
