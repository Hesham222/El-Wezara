<?php

namespace Organization\Exports\Payment;

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
        $data->push(['Id', 'User','Subscription','Balance','Payment amount','Payment method','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Subscriber->name,
                $record->Subscription->pricing_name,
                $record->payment_balance,
                $record->payment_amount,
                $record->payment_method,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
