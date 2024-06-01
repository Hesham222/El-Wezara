<?php

namespace Organization\Exports\RoomYearReport;

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
        $data->push(['البالغين','الاطفال','مجموع الغرف','مجموع الغرف المشغوله ',' مجموع الارباح ','مجموع الايرادات']);
        foreach ($records as $record) {
            $data->push([
                    'this year' => date('Y')
            ]);
                $data->push([
                    $record->adults()?$record->adults():'0',
                    $record->children()?$record->children():'0',
                    $record->rooms()?$record->rooms():'0',
                    $record->rooms_checked()?$record->rooms_checked():'0',
                    $record->profits()?$record->profits():'0',
                    $record->revenues()?$record->revenues():'0',
                ]);
                break;
        }
        foreach ($records as $record) {
            $data->push([
                'last year' => date('Y')-1
            ]);
            $data->push([
                $record->last_adults()?$record->last_adults():'0',
                $record->last_children()?$record->last_children():'0',
                $record->last_rooms()?$record->last_rooms():'0',
                $record->last_rooms_checked()?$record->last_rooms_checked():'0',
                $record->last_profits()?$record->last_profits():'0',
                $record->last_revenues()?$record->last_revenues():'0',
            ]);
            break;

        }
        return $data;
    }
}
