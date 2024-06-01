<?php

namespace Organization\Exports\VendorPrice;

use Maatwebsite\Excel\Concerns\FromCollection;

class VendorPriceExportData implements FromCollection
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
        $data->push(['Id', 'Vendor', 'Ingredient','Unit' ,'Price' ,'Price/Base Unit','Created at',]);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Vendor?$record->Vendor->name:"لا يوجد",
                $record->Ingredient?$record->Ingredient->name:"لا يوجد",
                $record->Ingredient->unit_of_measurement?$record->Ingredient->unit_of_measurement->name:"لا يوجد",
                $record->price?$record->price:"لا يوجد",
                $record->Ingredient?$record->Ingredient->final_cost:"لا يوجد",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

            ]);
        }
        return $data;
    }
}
