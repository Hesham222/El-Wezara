<?php

namespace Organization\Exports\GateShift;

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
        $data->push(['Id', 'Gate','Day', 'Employees' ,'Created at']);
        foreach ($records as $record) {
            $admins = [];
            foreach($record->gateShiftAdmins as $admin)
            {
                array_push($admins,$admin->organizationAdmin->name . " | " . $admin->organizationAdmin->phone);
            }
            $data->push([
                $record->id,
                $record->gate->name,
                $record->weekDay->name,
                $admins,
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
