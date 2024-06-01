<?php

namespace Organization\Exports\TrainerAttend;

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
        $data->push(['التعريف', 'اسم المدرب', 'نشأ في']);
        foreach ($records as $record) {
                $data->push([
                    $record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->id:"لا يوجد",
                    $record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->name:"لا يوجد",
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);

        }
        return $data;
    }
}
