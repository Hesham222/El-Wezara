<?php

namespace Organization\Exports\IngredientCategory;

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
        $data->push([' التعريف', 'الاسم','الوصف','الاب','انشا في ']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->description,
                $record->Parent?$record->Parent->name:"لا يوجد",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
