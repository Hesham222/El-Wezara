<?php

namespace Organization\Exports\RevenueSport;

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
        $data->push(['التعريف', 'اسم الرياضه','مجموع مبلغ الاشتراكات']);
        foreach ($records as $record) {
                $data->push([
                    $record->Training->ClubSport?$record->Training->ClubSport->id:"لا يوجد",
                    $record->Training->ClubSport?$record->Training->ClubSport->name:"لا يوجد",
                    $record->Training->Subscriptions?$record->Training->Subscriptions->sum('price'):"لا يوجد",
                ]);

        }
        return $data;
    }
}
