<?php
namespace Organization\Actions\Ticket;
use Illuminate\Http\Request;
use Organization\Models\{
    Ticket
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Ticket::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('organization_admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
