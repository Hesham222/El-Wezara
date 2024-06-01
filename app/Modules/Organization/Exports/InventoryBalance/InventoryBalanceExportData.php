<?php

namespace Organization\Exports\InventoryBalance;

use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryBalanceExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Unit','Quantity','Price' ,'Amount','Created at',]);
        foreach ($records as $record) {
            if (count($record->childs) > 0){
                $data->push([
                    $record->name,
                ]);
                foreach ($record->childs as $child){
                    $data->push([
                        $child->name?$child->name:"لا يوجد",
                    ]);
                    foreach ($child->ingredients as $ingredient){
                        $data->push([
                            $ingredient->id,
                            $ingredient->name?$ingredient->name:"لا يوجد",
                            $ingredient->unit_of_measurement?$ingredient->unit_of_measurement->name:"لا يوجد",
                            $ingredient->stock?$ingredient->stock:"لا يوجد",
                            $ingredient->final_cost?$ingredient->final_cost:"لا يوجد",
                            $ingredient->final_cost * $ingredient->stock,
                            date('d M Y', strtotime($ingredient->created_at)) ." - ". date('h:i a', strtotime($ingredient->created_at)),

                        ]);
                    }
                }

            }
        }
        return $data;
    }
}
