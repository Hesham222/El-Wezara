<?php

namespace Organization\Exports\RentContract;

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
        $data->push(['Id', 'Tenant', 'Rent Space', 'Amount', "Start Date",'End Date','Annual Increase', 'Revenue Share','Notes','Created By' ,'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->tenant->name,
                $record->rentSpace->name,
                $record->amount,
                $record->start_date,
                $record->end_date,
                $record->annual_increase,
                $record->revenue_share,
                $record->notes,
                $record->createdBy->name,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
