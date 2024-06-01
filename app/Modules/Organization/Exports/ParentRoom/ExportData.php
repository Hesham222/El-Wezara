<?php

namespace Organization\Exports\ParentRoom;

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
        $data->push(['Id','Hotel','Quantity','Start Room Number','Child Price','Extra Price','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                ($record->hotel) ? $record->hotel->name : "لا يوجد",
                $record->quantity,
                $record->start_room_num,
                $record->child_price,
                $record->extra_price,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
