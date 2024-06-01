<?php

namespace Organization\Exports\IngredientComponent;

use Maatwebsite\Excel\Concerns\FromCollection;

class IngredientComponentExportData implements FromCollection
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
        $data->push(['Id', 'الصنف','الوحده','الكميه','سعر الوحده','القيمه','Created at',]);
        foreach ($records as $record) {
            if (count($record->manufactured) > 0){
                $data->push([
                    $record->name,
                ]);
                foreach ($record->manufactured as $manufacture){
                    $data->push([
                        $manufacture->id,
                        $manufacture->name?$manufacture->name:"لا يوجد",
                        $manufacture->unit_of_measurement?$manufacture->unit_of_measurement->name:"لا يوجد",
                        $manufacture->quantity?$manufacture->quantity:"لا يوجد",
                        $manufacture->final_cost?$manufacture->final_cost:"لا يوجد",
                        $manufacture->final_cost * $manufacture->quantity,
                        date('d M Y', strtotime($manufacture->created_at)) ." - ". date('h:i a', strtotime($manufacture->created_at)),
                    ]);
                }
            }
        }
        return $data;
    }
}
