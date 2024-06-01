<?php
namespace Organization\Actions\Ticket;
use Illuminate\Http\Request;

use Organization\Models\{
    Ticket
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Ticket::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
