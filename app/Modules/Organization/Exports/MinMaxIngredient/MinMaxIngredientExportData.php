<?php

namespace Organization\Exports\MinMaxIngredient;

use Maatwebsite\Excel\Concerns\FromCollection;

class MinMaxIngredientExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Quantity','Unit' ,'Price','Amount','Min','Max','Created at',]);
        foreach ($records as $record) {
                    $data->push([
                        $record->id,
                        $record->name?$record->name:"لا يوجد",
                        $record->quantity?$record->quantity:"لا يوجد",
                        $record->unit_of_measurement?$record->unit_of_measurement->name:"لا يوجد",
                        $record->final_cost?$record->final_cost:"لا يوجد",
                        $record->final_cost * $record->stock,
                        $record->re_order_quantity?$record->re_order_quantity:"لا يوجد",
                        $record->stock?$record->stock:"لا يوجد",
                        date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

                    ]);
        }
        return $data;
    }
}
