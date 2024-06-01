<?php

namespace Organization\Exports\RoomLoss;

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
        $data->push(['Id','Hotel','Room','Notes','Customer','Loss Date','Status','Created By','Found Date','Found By','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->room->ParentRoom->hotel->name,
                $record->room->room_num,
                $record->missingInfo,
                $record->customer,
                $record->request_date,
                is_null($record->found_date) ? "Missing" : "Found",
                $record->createdBy ? $record->createdBy->name :"",
                $record->found_date,
                $record->found_by,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
