<?php

namespace Organization\Exports\ItemComponent;

use Maatwebsite\Excel\Concerns\FromCollection;

class ItemComponentExportData implements FromCollection
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
        $data->push(['Id', 'الصنف','الوحده','الكميه','سعر الوحده','القيمه','الكميه المنتجه' ,'التكلفه المباشره','5% أهلاكات','Created at',]);
        foreach ($records as $record) {
            if (count($record->components) > 0){
                $data->push([
                    $record->name,
                ]);
                foreach ($record->components as $component){
                    $data->push([
                        $component->id,
                        $component->ingredent?$component->ingredent->name:"لا يوجد",
                        $component->ingredent->unit_of_measurement?$component->ingredent->unit_of_measurement->name:"لا يوجد",
                        $component->quantity?$component->quantity:"لا يوجد",
                        $component->ingredent?$component->ingredent->final_cost:"لا يوجد",
                        $component->ingredent->final_cost * $component->quantity,
                        1,
                        $component->item?$component->item->price:"لا يوجد",
                        $component->item?$component->item->mortal:"لا يوجد",
                        date('d M Y', strtotime($component->created_at)) ." - ". date('h:i a', strtotime($component->created_at)),

                    ]);
                }

            }
        }
        return $data;
    }
}
