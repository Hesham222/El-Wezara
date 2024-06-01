<?php

namespace Organization\Exports\ExternalPayment;

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
        $data->push(['Id', 'User','Area','Payment amount','Payment method','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Subscriber->name,
                $record->ExternalReservation->ExternalPricing->ActivityArea->name,
                $record->payment_amount,
                $record->payment_method,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
