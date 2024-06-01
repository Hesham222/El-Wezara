<?php

namespace Organization\Exports\HotelWork;

use Maatwebsite\Excel\Concerns\FromCollection;

class FoundLossExportData implements FromCollection
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
        $data->push([' المفقودات','اسم العميل','تاريخ الفقد',' رقم الغرفة',' اسم الفندق','الموظف']);
        foreach ($records as $record) {
            $data->push([
                $record->missingInfo ,
                $record->customer,
            
                $record->request_date,
                $record->room?$record->room->room_num:"لا يوجد",
                $record->room?$record->room->ParentRoom->hotel->name:"لا يوجد",
                $record->createdBy?$record->createdBy->name:"لا يوجد",
           
            
            ]);
        }
        return $data;
    }
}