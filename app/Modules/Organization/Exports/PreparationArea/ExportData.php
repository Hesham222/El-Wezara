<?php

namespace Organization\Exports\PreparationArea;

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
        $data->push(['التعريف', 'منطقة التحضير','الوصف','انشئ فى ']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->description,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
