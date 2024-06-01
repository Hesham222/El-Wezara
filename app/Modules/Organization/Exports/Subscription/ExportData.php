<?php

namespace Organization\Exports\Subscription;

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
        $data->push(['Id', 'Subscriber','Training','Price','Session balance','Start date','End date','Payment balance','Paid date','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Subscriber->name,
                $record->Training->name,
                $record->price,
                $record->session_balance?$record->session_balance:'__',
                $record->start_date?$record->start_date:'__',
                $record->end_date?$record->end_date:'__',
                $record->payment_balance?$record->payment_balance:'__',
                $record->paid_date,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
