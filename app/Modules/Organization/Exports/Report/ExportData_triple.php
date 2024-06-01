<?php

namespace Organization\Exports\Report;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData_triple implements FromCollection
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
        $data->push(['Event Type','Name','Phone','Booking Date','Actual Price','Revenue','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->eventType->name,
                $record->contact_name,
                $record->contact_phone,
                $record->booking_date,
                $record->actual_price,
                0,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }

        return $data;
    }
}
