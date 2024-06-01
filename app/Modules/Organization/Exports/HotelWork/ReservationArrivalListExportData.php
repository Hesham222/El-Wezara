<?php

namespace Organization\Exports\HotelWork;

use Maatwebsite\Excel\Concerns\FromCollection;

class ReservationArrivalListExportData implements FromCollection
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
        $data->push(['رقم العميل','الاسم','تاريخ الوصول','تاريخ المغادرة',' VIP','التعريف','الاتصال']);
        foreach ($records as $record) {
            $data->push([
                $record->Customer?$record->Customer->id:"لا يوجد" ,
                $record->Customer?$record->Customer->name:"لا يوجد",
            
                $record->arrival_date,
                $record->departure_date,
                1,
                $record->id,
                $record->Customer?$record->Customer->phone:"لا يوجد",
           
            
            ]);
        }
        return $data;
    }
}