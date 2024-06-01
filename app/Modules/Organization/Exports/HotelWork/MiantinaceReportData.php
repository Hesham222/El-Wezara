<?php

namespace Organization\Exports\HotelWork;

use Maatwebsite\Excel\Concerns\FromCollection;

class MiantinaceReportData implements FromCollection
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
        $data->push([' الغرفة',' المشكلة','تاريخ الصيانة','  المسؤول']);
        foreach ($records as $record) {
            $data->push([
                $record->room->room_num ,
                $record->notes,
            
                $record->created_at,
                $record->employee?$record->employee->name:"لا يوجد",
             
           
            
            ]);
        }
        return $data;
    }
}