<?php
namespace Organization\Actions\TicketSubCategory;;
use Illuminate\Http\Request;

use Organization\Models\{
    TicketSubCategory
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = TicketSubCategory::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
