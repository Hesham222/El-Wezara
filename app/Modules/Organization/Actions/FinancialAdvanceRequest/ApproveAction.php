<?php
namespace Organization\Actions\FinancialAdvanceRequest;;
use Illuminate\Http\Request;

use Organization\Models\{
    FinancialAdvanceRequest
};

class ApproveAction
{
    public function execute( $id):void
    {
        $record = FinancialAdvanceRequest::FindOrFail($id);

        $record->status = 'Approved';
        $record->save();

    }
}
