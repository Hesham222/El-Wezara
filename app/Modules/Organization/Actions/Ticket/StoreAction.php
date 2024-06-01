<?php
namespace Organization\Actions\Ticket;
use Illuminate\Http\Request;
use Organization\Models\Reservation;
use Organization\Models\{
    Ticket
};
use Organization\Models\TicketCategory;
use Organization\Models\TicketPrice;

class StoreAction
{
    public function execute(Request $request)
    {
        $reservation = null;
        if (!is_null($request->input('reservation')))
            $reservation = Reservation::find($request->input('reservation'));

        $ticketId = (is_null($request->input('reservation'))) ? $request->input('ticketPrice') : $reservation->ticket_price_id;
        $ticket = TicketPrice::select('price')->find($ticketId);
        $record =  Ticket::create([
            'ticket_price_id'   => $ticketId,
            'gate_id'           => $request->input('gate'),
            'price'             => (!is_null($reservation)) ? 0 : $ticket->price,
            'created_by'        => auth('organization_admin')->user()->id,
        ]);
        if (!is_null($reservation))
        {
            $reservation->remaining_tickets = $reservation->remaining_tickets - 1;
            $reservation->save();
        }
        return $record;
    }
}
