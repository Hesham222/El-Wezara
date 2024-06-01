<?php
namespace Organization\Actions\VacationRequest;;
use Illuminate\Http\Request;

use Organization\Models\{
    VacationRequest
};

class ApproveAction
{
    public function execute( $id):void
    {
        $record = VacationRequest::FindOrFail($id);

        $record->employee->vacation_balance = $record->employee->vacation_balance - $record->vacation_duration;
        $record->employee->save();

        $record->status = 'Approved';
        $record->save();

    }
}
