<?php

namespace Organization\Exports\Package;

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
        $data->push(['Id', 'Name','Hall','Capacity','Actual Price','Final Price','Desc','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
//                $record->hall->name,
                $record->capacity,
                $record->description,
                $record->actual_pice,
                $record->final_pice,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
