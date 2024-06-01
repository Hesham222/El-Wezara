<?php

namespace Organization\Exports\CompanyReport;

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
        $data->push(['التعريف', 'اسم الشركه','ليالي الغرفة','ليالي الكبار','مجموع الارباح','صافي الإيرادات']);
        foreach ($records as $record) {
                $data->push([
                    $record->id?$record->id:"لا يوجد",
                    $record->name?$record->name:"لا يوجد",
                    $record->hotelReservations->sum('num_of_nights'),
                    $record->hotelReservations->sum('num_of_nights') - $record->hotelReservations->sum('num_of_children'),
                    $record->hotelReservations->sum('final_price'),
                    $record->hotelReservations->sum('paidAmount'),
                ]);

        }
        return $data;
    }
}
