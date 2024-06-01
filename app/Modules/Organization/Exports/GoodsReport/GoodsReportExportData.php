<?php

namespace Organization\Exports\GoodsReport;

use Maatwebsite\Excel\Concerns\FromCollection;

class GoodsReportExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Quantity','Price' ,'Total','Created at',]);
        foreach ($records as $record) {
            if (count($record->ingredients) > 0){
                $data->push([
                    $record->name,
                ]);
                foreach ($record->ingredients as $ingredient){
                    $data->push([
                        $ingredient->id,
                        $ingredient->name?$ingredient->name:"لا يوجد",
                        $ingredient->re_order_quantity?$ingredient->re_order_quantity:"لا يوجد",
                        $ingredient->final_cost?$ingredient->final_cost:"لا يوجد",
                        $ingredient->final_cost * $ingredient->re_order_quantity,
                        date('d M Y', strtotime($ingredient->created_at)) ." - ". date('h:i a', strtotime($ingredient->created_at)),

                    ]);
                }

            }
        }
        return $data;
    }
}
