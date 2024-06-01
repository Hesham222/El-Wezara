<?php

namespace Organization\Exports\Reservation;

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
        $data->push(['Id','Booking Date','From','To','Actual Price','paid_amount','Remaining Amount','Due Date','Package Name','Event Type','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->booking_date,
                $record->from,
                $record->to,
                $record->actual_price,
                $record->paid_amount,
                $record->remaining_amount,
                $record->payment_due_date,
                $record->package->name,
                $record->eventType->name,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
