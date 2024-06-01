<?php

namespace Organization\Exports\Vendor;

use Maatwebsite\Excel\Concerns\FromCollection;

class IngredientExportData implements FromCollection
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
        $data->push(['Id', 'مكون الوجبات','المورد','السعر', 'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Ingredient->name,
                $record->Vendor->name,
                $record->price,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
