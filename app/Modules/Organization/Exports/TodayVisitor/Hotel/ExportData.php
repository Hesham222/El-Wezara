<?php

namespace Organization\Exports\TodayVisitor\Hotel;

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
        $data->push(['Id','Name']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Customer->name,
            ]);
        }
        return $data;
    }
}
