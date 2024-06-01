<?php
namespace Organization\Actions\TicketSubCategory;
use Illuminate\Http\Request;
use Organization\Models\{Ticket, TicketCategory, TicketPrice, TicketSubCategory};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = TicketSubCategory::find($request->resource_id);
//        if(!$record)
//            return false;
//        $record->deleted_by = auth('organization_admin')->user()->id;
//        $record->save();
        if (!$record){
            return false;
        }
        $tickect_pricesIDs =TicketPrice::where('ticket_sub_category_id',$record->id)->pluck('id');

       Ticket::whereIn('ticket_price_id',$tickect_pricesIDs)->forceDelete();

      // TicketCategory::where('id',1)->delete();
        //$record->forceDelete();
        TicketPrice::where('ticket_sub_category_id',$record->id)->forceDelete();
        $record->forceDelete();
      //  dd('kjkjk');
        return $record->id;
    }
}
