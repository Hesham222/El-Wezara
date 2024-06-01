<?php

namespace Organization\Exports\Report;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData_customers implements FromCollection
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
        $data->push(['Name','Phone','Event Type','Remaining Amount','Payment Due Date','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->contact_name,
                $record->contact_phone,
                $record->eventType->name,
                $record->remaining_amount,
                $record->payment_due_date,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }

        return $data;
    }
}
