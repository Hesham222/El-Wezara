<?php
namespace Organization\Actions\VacationRequest;;
use Illuminate\Http\Request;

use Organization\Models\{
    VacationRequest
};

class RejectAction
{
    public function execute( $id):void
    {
        $record = VacationRequest::FindOrFail($id);

        $record->status = 'Rejected';
        $record->save();

    }
}
