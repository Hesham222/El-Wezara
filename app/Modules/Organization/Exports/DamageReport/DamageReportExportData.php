<?php

namespace Organization\Exports\DamageReport;

use Maatwebsite\Excel\Concerns\FromCollection;

class DamageReportExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Unit' ,'Quantity','Price' ,'Value','Created at',]);
        foreach ($records as $record) {
                $data->push([
                    $record->id,
                    $record->ingredient?$record->ingredient->name:"لا يوجد",
                    $record->ingredient->unit_of_measurement?$record->ingredient->unit_of_measurement->name:"لا يوجد",
                    $record->quantity?$record->quantity:"لا يوجد",
                    $record->ingredient?$record->ingredient->final_cost:"لا يوجد",
                    $record->quantity * $record->ingredient->final_cost,
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

                ]);

        }
        return $data;
    }
}
