<?php

namespace Organization\Exports\Ingredient;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCardData implements FromCollection
{
    private $record;

    public function __construct($record)
    {
        $this->record = $record;
    }

    public function collection()
    {
        $record = $this->record;
        $data = collect([]);
        $data->push(['Arabic name', 'Id','Min','Max','Unit', 'Import','Export','balance', 'Created at']);
    
            $data->push([
              
                $record->getTranslation('name', 'ar'),
                $record->id,
                $record->re_order_quantity,
                $record->stock,
                $record->unit_of_measurement->name,
                $record->imports(),
                $record->exports(),
                $record->final_cost* $record->stock,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
       
        return $data;
    }
}