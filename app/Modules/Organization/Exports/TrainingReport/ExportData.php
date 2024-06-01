<?php

namespace Organization\Exports\TrainingReport;

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
        $data->push(['اسم التدريب', 'اسم المدرب','اليوم','وقت البدايه','وقت النهايه']);
        foreach ($records as $record) {
                $data->push([
                    $record->Training->name?$record->Training->name:"لا يوجد",
                    $record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->name:"لا يوجد",
                    $record->day?$record->day:"لا يوجد",
                    $record->start_time?$record->start_time:"لا يوجد",
                    $record->end_time?$record->end_time:"لا يوجد",
                ]);
        }
        return $data;
    }
}
