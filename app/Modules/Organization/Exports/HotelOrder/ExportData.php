<?php

namespace Organization\Exports\HotelOrder;

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
        $data->push(['التعريف', 'اسم الفندق','الحاله','سبب الرفض ان وجد','نشأ بواسطه من','انشا في ']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->hotel->name,
                $record->status,
                $record->rejection_reason? $record->rejection_reason : "__",
                $record->createdBy?$record->createdBy->name:"لا يوجد",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
