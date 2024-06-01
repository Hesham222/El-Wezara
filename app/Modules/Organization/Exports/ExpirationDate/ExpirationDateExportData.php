<?php

namespace Organization\Exports\ExpirationDate;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExpirationDateExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Quantity','Unit' ,'Value' ,'Expiration Date','Created at',]);
        foreach ($records as $record) {
            foreach ($record->ingredient_quantities as $ingredient_quantity){
                $data->push([
                    $ingredient_quantity->id,
                    $ingredient_quantity->ingredient?$ingredient_quantity->ingredient->name:"لا يوجد",
                    $ingredient_quantity->quantity?$ingredient_quantity->quantity:"لا يوجد",
                    $ingredient_quantity->ingredient->unit_of_measurement?$ingredient_quantity->ingredient->unit_of_measurement->name:"لا يوجد",
                    $ingredient_quantity->quantity * $ingredient_quantity->ingredient->final_cost,
                    $ingredient_quantity->expiration_date?$ingredient_quantity->expiration_date:"لا يوجد",
                    date('d M Y', strtotime($ingredient_quantity->created_at)) ." - ". date('h:i a', strtotime($ingredient_quantity->created_at)),

                ]);
            }
        }
        return $data;
    }
}
