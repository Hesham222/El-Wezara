<?php

namespace Organization\Exports\ClubReport;

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
        $data->push(['التعريف', 'اسم المشترك','التدريب','وقت التدريب','اسم المدرب', 'نشأ في']);
        foreach ($records as $record) {
            foreach ($record->Training->Subscriptions as $subscription){
                $data->push([
                    $subscription->Subscriber?$subscription->Subscriber->id:"لا يوجد",
                    $subscription->Subscriber?$subscription->Subscriber->name:"لا يوجد",
                    $subscription->Subscriber?$subscription->Training->name:"لا يوجد",
                    $record->start_time?$record->start_time:"لا يوجد",
                    $record->Training?$subscription->Training->FreelanceTrainer->name:"لا يوجد",
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);
            }

        }
        return $data;
    }
}
