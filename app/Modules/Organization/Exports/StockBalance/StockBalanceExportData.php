<?php

namespace Organization\Exports\StockBalance;

use Maatwebsite\Excel\Concerns\FromCollection;

class StockBalanceExportData implements FromCollection
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
        $data->push(['Categories']);
        foreach ($records as $record) {
            if (count($record->ingredients) > 0){
                $data->push([
                    $record->name,
                    $record->generalTotal(),
                ]);
                foreach ($record->childs as $child){
                    $data->push([
                        $child->name?$child->name:"لا يوجد",
                        $child->total(),
                    ]);
                }

            }
        }
        return $data;
    }
}
