<?php

namespace Organization\Exports\resevedIngredentSupplier;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData implements FromCollection
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
        $data->push(['PoId','Created at', 'Supplier','Ingredent','Quantity' ,'Unit','Base Price' ,'Tolal Price' ]);
        foreach ($records as $record) {
            foreach($record->items as $item){

                $data->push([
                    $item->purchase_order_id,
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at)),
                    $record->vendor->name,
                    $item->item->name,
                    $item->received_quantity,
                    $item->item->unit_of_measurement->name,
                    $item->item->final_cost?$item->item->final_cost:$item->item->cost,
                    $item->item->final_cost? $item->item->final_cost* $item->received_quantity:$item->item->cost* $item->received_quantity
                ]);
            }
           
        }
        return $data;
    }
}