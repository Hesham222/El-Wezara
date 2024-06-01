<?php

namespace Organization\Exports\LaundrySubCategory;

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
        $data->push(['Id', 'Name','Parent Category','description','Created at']);
        foreach ($records as $record) {
            if($record->description == null){
                $data->push([
                    $record->id,
                    $record->name,
                    $record->parent->name,
                    'no description',
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);
            }
            else{
                $data->push([
                    $record->id,
                    $record->name,
                    $record->parent->name,
                    $record->description,
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);
            }
        }
        return $data;
    }
}
