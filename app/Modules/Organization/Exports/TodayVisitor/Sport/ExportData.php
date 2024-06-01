<?php

namespace Organization\Exports\TodayVisitor\Sport;

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
        $data->push(['Id', 'Trainee','Training']);
        foreach ($records as $record) {
            foreach($record->Training->Subscriptions as $subscription)
            {
                $data->push([
                    $subscription->Subscriber?$subscription->Subscriber->id:"لا يوجد",
                    $subscription->Subscriber?$subscription->Subscriber->name:"لا يوجد",
                    $subscription->Subscriber?$subscription->Training->name:"لا يوجد",
                ]);
            }
        }
        return $data;
    }
}
