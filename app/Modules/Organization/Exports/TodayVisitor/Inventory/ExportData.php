<?php

namespace Organization\Exports\TodayVisitor\Inventory;

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
        $data->push(['Id', 'name']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->vendor->name
            ]);
        }
        return $data;
    }
}
