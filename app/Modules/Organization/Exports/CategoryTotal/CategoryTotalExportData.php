<?php

namespace Organization\Exports\CategoryTotal;

use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryTotalExportData implements FromCollection
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
        $data->push(['Id', 'Category Name','Total','Created at',]);
        foreach ($records as $record) {
            if ($record->parent_id == 0){
                $data->push([
                    $record->name,
                ]);
                foreach ($record->childs as $child){
                    $data->push([
                        $child->id,
                        $child->name?$child->name:"لا يوجد",
                        $child->IngredientOrderTotal(),
                    ]);
                }
            }
        }
        return $data;
    }
}
