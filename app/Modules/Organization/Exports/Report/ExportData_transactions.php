<?php

namespace Organization\Exports\Report;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData_transactions implements FromCollection
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
        $data->push(['Name','Phone','Event Type','Paid Amount','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->contact_name,
                $record->contact_phone,
                $record->reservation->eventType->name,
                $record->paid_amount,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }

        return $data;
    }
}
