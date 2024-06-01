<?php

namespace Organization\Exports\SpenPermission;

use Maatwebsite\Excel\Concerns\FromCollection;

class PurchaseExportData implements FromCollection
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
        $data->push(['Id', 'Vendor Name','Total' ,'Ingredients' ,'Created at','CreatedBy']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->vendor?$record->vendor->name:"لا يوجد",
                $record->total,
                $record->drow_excel(),
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

            ]);
        }
        return $data;
    }
}
