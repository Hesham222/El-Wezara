<?php

namespace Organization\Exports\SubAssetProduct;

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
        $data->push(['Id', 'Name','Parent Product','Start Value','Current Value','Entry Date','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->ParentProduct->name,
                $record->start_value,
                $record->current_value,
                $record->entry_date,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
