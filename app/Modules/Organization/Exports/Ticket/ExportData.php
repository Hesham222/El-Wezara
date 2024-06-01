<?php

namespace Organization\Exports\Ticket;

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
        $data->push(['Id', 'Category','Sub Category', 'Price', 'Gate', 'Created By' ,'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->details->category?$record->details->category->name : "لا يوجد",
                $record->details->subCategory?$record->details->subCategory->name : "لا يوجد",
                $record->details?$record->details->price : "لا يوجد",
                $record->gate?$record->gate->name : "لا يوجد",
                $record->createdBy ? $record->createdBy->name : "NONE",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
