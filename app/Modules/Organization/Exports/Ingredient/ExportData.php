<?php

namespace Organization\Exports\Ingredient;

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
        $data->push(['id','English name','Arabic name', 'English description','Arabic description','quantity','cost', 'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->getTranslation('name', 'en'),
                $record->getTranslation('name', 'ar'),
                $record->getTranslation('description', 'en'),
                $record->getTranslation('description', 'ar'),
                $record->quantity,
                $record->cost,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
