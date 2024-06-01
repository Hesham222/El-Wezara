<?php

namespace Organization\Exports\Tenant;

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
        $data->push(['Id', 'Name','Primary Name','Primary Phone','Notes', 'Created by', 'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->primary_name,
                $record->primary_phone,
                $record->notes,
                $record->createdBy->name,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
