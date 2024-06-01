<?php

namespace Organization\Exports\ExternalReservation;

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
        $data->push(['Id', 'Subscriber','Area','Num of hours','date','Start time','End time','Total','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Subscriber->name,
                $record->ExternalPricing->ActivityArea->name,
                $record->num_of_hours,
                $record->date?$record->date:'__',
                $record->start_time?$record->start_time:'__',
                $record->end_time?$record->end_time:'__',
                $record->total?$record->total:'__',
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
