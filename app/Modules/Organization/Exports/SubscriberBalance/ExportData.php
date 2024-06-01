<?php

namespace Organization\Exports\SubscriberBalance;

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
        $data->push(['التعريف', 'اسم المشترك','رقم الهاتف المحمول ','رصيد المشترك','نشأ في']);
        foreach ($records as $record) {
                $data->push([
                    $record->id?$record->id:"لا يوجد",
                    $record->name?$record->name:"لا يوجد",
                    $record->phone?$record->phone:"لا يوجد",
                    $record->Subscriptions?$record->Subscriptions->sum('payment_balance'):"لايوجد",
                    date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
                ]);

        }
        return $data;
    }
}
