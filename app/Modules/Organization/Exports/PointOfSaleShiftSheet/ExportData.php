<?php

namespace Organization\Exports\PointOfSaleShiftSheet;

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
        $data->push(['Id', 'Shift Date','Employee','PointOfSale','Shift Start','Start Balance','Shift End','End Balance','Orders Amount']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->shift_date,
                $record->orgnization_admin->name,
                $record->point_of_sale->name,
                $record->shift_start,
                $record->start_balance,
                $record->shift_end,
                $record->end_balance,
                $record->ordersAmount,
            ]);
        }
        return $data;
    }
}
