<?php

namespace Organization\Exports\Training;

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
        $data->push(['Id', 'Name','Club Sport','Activity Area','Freelance Trainer','Type',
            'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->ClubSport->name,
                $record->ActivityArea->name,
                $record->FreelanceTrainer->name,
                $record->type,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
