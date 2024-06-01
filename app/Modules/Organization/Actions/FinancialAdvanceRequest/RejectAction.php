<?php
namespace Organization\Actions\FinancialAdvanceRequest;;
use Illuminate\Http\Request;

use Organization\Models\{
    FinancialAdvanceRequest
};

class RejectAction
{
    public function execute( $id):void
    {
        $record = FinancialAdvanceRequest::FindOrFail($id);

        $record->status = 'Rejected';
        $record->save();

    }
}
