<?php
namespace Organization\Actions\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\GateShiftSheet;
use Organization\Models\Ticket;

class EndShiftAction
{
    public function execute(Request $request)
    {
        $record = GateShiftSheet::find($request->input('shift'));
        $ticketsAmount = Ticket::select('price')->where([ ['created_by',$record->organization_admin_id],['gate_id',$record->gate_id] ])->whereDate('created_at',$record->shift_date)->sum('price');
        $numberOfTickets = Ticket::select('id')->where([ ['created_by',$record->organization_admin_id],['gate_id',$record->gate_id] ])->whereDate('created_at',$record->shift_date)->count();

        $record->shift_end   = Carbon::now();
        $record->end_balance = $request->input('endBalance');
        $record->ticketsAmount = $ticketsAmount;
        $record->no_of_tickets = $numberOfTickets;
        $record->save();
        return $record;
    }
}
