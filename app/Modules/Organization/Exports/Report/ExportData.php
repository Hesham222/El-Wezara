<?php

namespace Organization\Exports\Report;

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
        $data->push(['Title','Name','Phone','Address','National_id','Event Type','Package','Booking Date','From','Actual Price','Paid Amount','Remaining Amount','Payment Due Date','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->contact_title,
                $record->contact_name,
                $record->contact_phone,
                $record->contact_address,
                $record->contact_national_id,
                $record->eventType->name,
                $record->package->name,
                $record->booking_date,
                $record->from,
                $record->actual_price,
                $record->paid_amount,
                $record->remaining_amount,
                $record->payment_due_date,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }

        return $data;
    }
}
