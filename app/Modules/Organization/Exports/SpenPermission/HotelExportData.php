<?php

namespace Organization\Exports\SpenPermission;

use Maatwebsite\Excel\Concerns\FromCollection;

class HotelExportData implements FromCollection
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
        $data->push(['Id','Hotel' ,'Ingredients' ,'total','Created By', 'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->hotel?$record->hotel->name:"لا يوجد",
                $record->drow_excel(),
                $record->total,
                $record->createdBy?$record->createdBy->name:"لا يوجد",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

            ]);
        }
        return $data;
    }
}
