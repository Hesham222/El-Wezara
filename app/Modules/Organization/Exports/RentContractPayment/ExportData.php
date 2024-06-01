<?php

namespace Organization\Exports\RentContractPayment;

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
        $data->push(['Id','Rent Space','Tenant Name','Payment Date','Amount',"Status",'Payment Type','Paid At']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->rentContract->tenant->name,
                $record->rentContract->rentSpace->name,
                $record->payment_date,
                $record->amount,
                ($record->status == 0) ? "لم يتم السداد" : "تم الدفع",
                ($record->paidBy) ? $record->paidBy : "-" ,
                ($record->status == 1) ? date('d M Y', strtotime($record->updated_at)) ." - ". date('h:i a', strtotime($record->updated_at)) : "-",
            ]);
        }
        return $data;
    }
}
