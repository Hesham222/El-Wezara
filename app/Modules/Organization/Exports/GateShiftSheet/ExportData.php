<?php

namespace Organization\Exports\GateShiftSheet;

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
        $data->push(['Id', 'Shift Date','Employee','Gate','Shift Start','Start Balance','Shift End','End Balance','Tickets Amount']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->shift_date,
                $record->gateAdmin->name,
                $record->gate->name,
                $record->shift_start,
                $record->start_balance,
                $record->shift_end,
                $record->end_balance,
                $record->ticketsAmount,
            ]);
        }
        return $data;
    }
}
