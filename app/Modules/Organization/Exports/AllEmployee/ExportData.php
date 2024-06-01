<?php

namespace Organization\Exports\AllEmployee;

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
        $data->push(['رقم الغرفه','الاسم','تاريخ الوصول',' تاريخ المغادرة ','الرصيد']);
        foreach ($records as $record) {
                $data->push([
                    $record->room?$record->room->room_num:"لا يوجد",
                    $record->Customer?$record->Customer->name:"لا يوجد",
                    $record->arrival_date?$record->arrival_date:"لا يوجد",
                    $record->departure_date?$record->departure_date:"لا يوجد",
                    $record->final_price?$record->final_price:"لا يوجد",
                ]);

        }
        return $data;
    }
}
