<?php

namespace Organization\Exports\RoomTypeDayReport;

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
        $data->push(['نوع الغرفه', 'عدد الغرف','البالغين','الاطفال','عدد الأسرة الإضافية' ,' مجموع الارباح ','صافي الإيرادات ',' مجموع المتبقي']);
        foreach ($records as $record) {
                $data->push([
                    $record->name?$record->name:"لا يوجد",
                    $record->hotelReservations->count('room_id'),
                    $record->hotelReservations->sum('num_of_nights') - $record->hotelReservations->sum('num_of_children'),
                    $record->hotelReservations->sum('num_of_children')?$record->hotelReservations->sum('num_of_children'):" 0",
                    $record->hotelReservations->sum('num_of_extra_beds')?$record->hotelReservations->sum('num_of_extra_beds'):" 0",
                    $record->hotelReservations->sum('final_price')?$record->hotelReservations->sum('final_price'):"0",
                    $record->hotelReservations->sum('paidAmount')?$record->hotelReservations->sum('paidAmount'):"0 ",
                    $record->hotelReservations->sum('remainingAmount')?$record->hotelReservations->sum('remainingAmount'):"0 "
                ]);

        }
        return $data;
    }
}
