<?php

namespace Organization\Exports\Customer;

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
        $data->push(['التعريف', 'الاسم','نوع العميل ','رقم الهاتف','النوع','العنوان','البريد','تاريخ الميلاد','الجنسية','تاريخ الانشاء']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->name,
                $record->CustomerType->name,
                $record->phone,
                $record->email,
                $record->gender,
                $record->address,
                $record->date_of_birth,
                $record->nationality,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
