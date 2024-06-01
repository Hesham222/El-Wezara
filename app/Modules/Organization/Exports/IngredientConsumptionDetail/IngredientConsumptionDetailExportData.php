<?php

namespace Organization\Exports\IngredientConsumptionDetail;

use Maatwebsite\Excel\Concerns\FromCollection;

class IngredientConsumptionDetailExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Quantity before Stocking','Quantity after Stocking','Price before Stocking' ,'Price After Stocking','Consumption','Created at',]);
        foreach ($records as $record) {
                    $data->push([
                        $record->id,
                        $record->ingredient?$record->ingredient->name:"لا يوجد",
                        $record->quantity_before?$record->quantity_before:"لا يوجد",
                        $record->quantity_after?$record->quantity_after:"لا يوجد",
                        $record->quantity_before * $record->ingredient->final_cost,
                        $record->quantity_after * $record->ingredient->final_cost,
                        ($record->quantity_before * $record->ingredient->final_cost) - ($record->quantity_after * $record->ingredient->final_cost),
                        date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

                    ]);
        }
        return $data;
    }
}
