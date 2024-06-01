<?php

namespace Organization\Exports\Subscription;

use Maatwebsite\Excel\Concerns\FromCollection;

class CancelExportData implements FromCollection
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
        $data->push(['Id', 'اسم المشترك','سبب الغاء الاشتراك','اسم الاشتراك','سعر الاشتراك',
            'المبلغ المدفوع','عدد مرات الحضور','سعر الجلسه','سعر الحضور',
            'باقي المدفوع','نسبه الخصم','اجمالي المسترجع بعد الخصم','تم الالغاء بواسطه','تم الالغاء في']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->Subscriber?$record->Subscriber->name:"لا يوجد",
                $record->reason_of_cancelled?$record->reason_of_cancelled:"لا يوجد",
                $record->pricing_name?$record->pricing_name:"لا يوجد",
                $record->price?$record->price:"لا يوجد",
                $record->Payments?$record->Payments->sum('payment_amount'):"لا يوجد",
                $record->attendance?$record->attendance:"لا يوجد",
                $record->price?$record->Round():"لا يوجد",
                $record->rest_of_paid?$record->rest_of_paid:"لا يوجد",
                $record->commission?$record->commission:"لا يوجد",
                $record->amount_after_discount?$record->amount_after_discount:"لا يوجد",
                $record->cancelledBy?$record->cancelledBy->name :"لا يوجد",
                date('d M Y', strtotime($record->cancelled_at)) ." - ". date('h:i a', strtotime($record->cancelled_at))
            ]);
        }
        return $data;
    }
}
