<?php

namespace Organization\Exports\HotelWork;

use Maatwebsite\Excel\Concerns\FromCollection;

class ArrivalListExportData implements FromCollection
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
        $data->push(['رقم الغرفة','الاسم','الحالة','تاريخ الوصول','تاريخ المغادرة','عدد الاطفال','عدد الاسرة الاضافية','نوع الغرفة','الشركة','بورد']);
        foreach ($records as $record) {
            $data->push([
                $record->Room->room_num ,
                $record->Customer?$record->Customer->name:"لا يوجد",
                $record->checkIn?"IN":" EXP",
                $record->arrival_date,
                $record->departure_date,
                $record->num_of_children,
                $record->num_of_extra_beds,
                $record->RoomType?$record->RoomType->name:"لا يوجد",
                $record->supplier?$record->supplier->name:"لا يوجد",
                "BB"
            ]);
        }
        return $data;
    }
}