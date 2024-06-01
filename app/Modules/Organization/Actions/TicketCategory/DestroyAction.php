<?php
namespace Organization\Actions\TicketCategory;;
use Illuminate\Http\Request;

use Organization\Models\{
    TicketCategory
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = TicketCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
