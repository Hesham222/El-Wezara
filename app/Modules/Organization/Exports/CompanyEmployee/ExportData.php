<?php

namespace Organization\Exports\CompanyEmployee;

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
        $data->push(['رقم الغرفه','الاسم','الحاله','تاريخ الوصول','تاريخ المغادرة','البالغين', 'الاطفال','نوع الغرفه','اسم الشركه','مجموع الارباح','صافي الإيرادات']);
        foreach ($records as $record) {
            $data->push([
                $record->name?$record->name:"لا يوجد",
            ]);
            if (count($record->hotelReservations) > 0){
                foreach ($record->hotelReservations as $hotelReservation){
                    $data->push([
                        $hotelReservation->Room?$hotelReservation->Room->room_num:"لا يوجد",
                        $hotelReservation->Customer?$hotelReservation->Customer->name:"لا يوجد",
                        $hotelReservation->checkIn == 1? "IN":"EXP",
                        $hotelReservation->arrival_date?$hotelReservation->arrival_date:"لا يوجد",
                        $hotelReservation->departure_date?$hotelReservation->departure_date:"لا يوجد",
                        $hotelReservation->num_of_nights?$hotelReservation->num_of_nights - $hotelReservation->num_of_children:"0",
                        $hotelReservation->num_of_children?$hotelReservation->num_of_children:"0",
                        $hotelReservation->RoomType?$hotelReservation->RoomType->name:"لا يوجد",
                        $hotelReservation->supplier?$hotelReservation->supplier->name:"لا يوجد",
                        $hotelReservation->final_price?$hotelReservation->final_price:"0",
                        $hotelReservation->paidAmount?$hotelReservation->paidAmount:"0",
                    ]);
                }
            }
        }
        return $data;
    }
}
