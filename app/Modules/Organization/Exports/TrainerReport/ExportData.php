<?php

namespace Organization\Exports\TrainerReport;

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
        $data->push(['التعريف','اسم المدرب','نشأ في']);
        foreach ($records as $record) {
            foreach ($record->Training->ClubSport->freelanceTrainings as $trainer){
                $data->push([
                    $trainer->id?$trainer->id:"لا يوجد",
                    $trainer->name?$trainer->name:"لا يوجد",
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);
            }

        }
        return $data;
    }
}
