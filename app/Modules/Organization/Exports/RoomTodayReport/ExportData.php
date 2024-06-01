<?php

namespace Organization\Exports\RoomTodayReport;

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
        $data->push(['رقم الغرفه','الاسم','الحاله','تاريخ الوصول',' تاريخ المغادرة ']);
        foreach ($records as $record) {
                $data->push([
                    $record->room?$record->room->room_num:"لا يوجد",
                    $record->Customer?$record->Customer->name:"لا يوجد",
                    $record->checkIn == 1? "IN":"EXP",
                    $record->arrival_date?$record->arrival_date:"لا يوجد",
                    $record->departure_date?$record->departure_date:"لا يوجد",
                ]);

        }
        return $data;
    }
}
