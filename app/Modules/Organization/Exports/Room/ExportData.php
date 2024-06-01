<?php

namespace Organization\Exports\Room;

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
        $data->push(['Id','Hotel','room number','status','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                ($record->ParentRoom->hotel) ? ($record->ParentRoom->hotel->name) : "لا يوجد",
                $record->room_num,
                $record->status,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
