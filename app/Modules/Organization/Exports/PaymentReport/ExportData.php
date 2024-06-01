<?php

namespace Organization\Exports\PaymentReport;

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
        $data->push(['التعريف', 'اسم المشترك','رقم الهاتف المحمول','الرقم التعريفي للدفع','الرقم التعريفي للأشتراك','اسم التدريب','مبلغ الدفع','تاريخ الدفع']);
        foreach ($records as $record) {
            foreach ($record->Training->Subscriptions as $subscription){
            foreach ($subscription->Payments as $payment){
                $data->push([
                    $payment->Subscription->Subscriber?$payment->Subscription->Subscriber->id:"لا يوجد",
                    $payment->Subscription->Subscriber?$payment->Subscription->Subscriber->name:"لا يوجد",
                    $payment->Subscription->Subscriber?$payment->Subscription->Subscriber->phone:"لا يوجد",
                    $payment->id?$payment->id:"لا يوجد",
                    $payment->Subscription?$payment->Subscription->id:"لا يوجد",
                    $payment->Subscription->Training?$payment->Subscription->Training->name:"لا يوجد",
                    $payment->payment_amount?$payment->payment_amount:"لا يوجد",
                    $payment->Subscription?$payment->Subscription->paid_date:"لا يوجد",
                ]);
            }
            }

        }
        return $data;
    }
}
