<?php

namespace Organization\Exports\IngredientConsumption;

use Maatwebsite\Excel\Concerns\FromCollection;

class IngredientConsumptionExportData implements FromCollection
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
        $data->push(['Id', 'Created by','Ingredient','Price before Stocking' ,'Price After Stocking','Consumption','Created at',]);
        foreach ($records as $record) {
                    $data->push([
                        $record->id,
                        $record->createdBy?$record->createdBy->name:"لا يوجد",
                        $record->Ingredient?$record->Ingredient->name:"لا يوجد",
                        $record->totalBefore(),
                        $record->totalAfter(),
                        $record->totalBefore() - $record->totalAfter(),
                        date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),

                    ]);
        }
        return $data;
    }
}
