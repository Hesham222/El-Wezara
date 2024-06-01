<?php

namespace Organization\Exports\AreaReport;

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
        $data->push(['التعريف', 'اسم المنطقه','اسم التدريب','وقت بدايه التدريب','وقت انتهاء التدريب', 'نشأ في']);
        foreach ($records as $record) {
                $data->push([
                    $record->Training->ActivityArea?$record->Training->ActivityArea->name:"لا يوجد",
                    $record->Training?$record->Training->name:"لا يوجد",
                    $record->start_time?$record->start_time:"لا يوجد",
                    $record->end_time?$record->end_time:"لا يوجد",
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);

        }
        return $data;
    }
}
