<?php

namespace Organization\Exports\HotelInventory;

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
        $data->push(['التعريف', 'المكون','الفندق','الكميه','نشأ في']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->ingredient->name? $record->ingredient->name:"لا يوجد",
                $record->hotel->name? $record->hotel->name:"لا يوجد",
                $record->quantity? $record->quantity:"لا يوجد",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
