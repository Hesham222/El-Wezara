<?php
namespace Organization\Actions\TicketCategory;
use Illuminate\Http\Request;
use Organization\Models\{Ticket, TicketCategory, TicketPrice};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = TicketCategory::find($request->resource_id);
        if(!$record)
            return false;
//        $record->deleted_by = auth('organization_admin')->user()->id;
//        $record->save();

        $tickect_pricesIDs =TicketPrice::where('ticket_category_id',$record->id)->pluck('id');

        Ticket::whereIn('ticket_price_id',$tickect_pricesIDs)->forceDelete();
        TicketPrice::where('ticket_category_id',$record->id)->forceDelete();
        $record->forceDelete();
        return $record->id;
    }
}
