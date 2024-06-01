<?php

namespace Organization\Exports\IngredientTotal;

use Maatwebsite\Excel\Concerns\FromCollection;

class IngredientTotalExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Unit','Quantity','Price' ,'Total','Created at',]);
        foreach ($records as $record) {
            if (count($record->ingredients) > 0){
                $data->push([
                    $record->name,
                ]);
                foreach ($record->ingredients as $ingredient){
                    $data->push([
                        $ingredient->id,
                        $ingredient->name?$ingredient->name:"لا يوجد",
                        $ingredient->unit_of_measurement?$ingredient->unit_of_measurement->name:"لا يوجد",
                        $ingredient->IngredientSumQuantity(),
                        $ingredient->final_cost?$ingredient->final_cost:"لا يوجد",
                        $ingredient->IngredientOrderTotal(),
                    ]);
                }

            }
        }
        return $data;
    }
}
