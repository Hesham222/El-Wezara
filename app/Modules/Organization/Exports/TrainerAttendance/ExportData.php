<?php

namespace Organization\Exports\TrainerAttendance;

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
        $data->push(['Id', 'Name','Mobile','Second Mobile','Subscriber Type','National Id','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->phone,
                $record->second_phone?$record->second_phone:'__',
                $record->SubscriberType->type,
                $record->national_id,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
