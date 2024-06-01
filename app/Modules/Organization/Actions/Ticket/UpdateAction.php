<?php
namespace Organization\Actions\Ticket;
use Illuminate\Http\Request;
use Organization\Models\{
    Ticket
};
use Organization\Models\TicketPrice;

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $ticket = TicketPrice::select('price')->find($request->input('ticketPrice'));
        $record = Ticket::find($id);
        $record->ticket_price_id  = $request->input('ticketPrice');
        $record->gate_id          = $request->input('gate');
        $record->price            = $ticket->price;
        //$record->created_by       = $request->input('owner');
        $record->save();
        return $record;
    }
}
