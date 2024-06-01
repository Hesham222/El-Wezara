<?php

namespace Organization\Exports\PurchaseOrderReport;

use Maatwebsite\Excel\Concerns\FromCollection;

class PurchaseOrderReportExportData implements FromCollection
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
        $data->push(['Id', 'Ingredient','Unit','Quantity' ,'Last Price' ,'Price','Amount','Created at',]);
        foreach ($records as $record) {
            foreach ($record->items as $item){
                $data->push([
                    $item->id,
                    $item->item->name?$item->item->name:"لا يوجد",
                    $item->item->unit_of_measurement?$item->item->unit_of_measurement->name:"لا يوجد",
                    $item->received_quantity?$item->received_quantity:"لا يوجد",
                    $item->item->last_selling_price?$item->item->last_selling_price:"لا يوجد",
                    $item->final_cost?$item->final_cost:"لا يوجد",
                    $item->total?$item->total:"لا يوجد",
                    date('d M Y', strtotime($item->created_at)) ." - ". date('h:i a', strtotime($item->created_at)),

                ]);
            }
        }
        return $data;
    }
}
