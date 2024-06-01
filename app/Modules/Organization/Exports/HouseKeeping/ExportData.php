<?php

namespace Organization\Exports\HouseKeeping;

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
        $data->push(['Id','Hotel','Room','Status','Occupied Date']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->room->ParentRoom->hotel->name,
                $record->room->room_num,
                $record->status,
                $record->occupied_date,
            ]);
        }
        return $data;
    }
}
