<?php
namespace Organization\Actions\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\GateShiftSheet;

class StartShiftAction
{
    public function execute(Request $request)
    {
        $record =  GateShiftSheet::create([
            'organization_admin_id'        => auth('organization_admin')->user()->id,
            'gate_id'           => $request->input('gate'),
            'shift_date'        => Carbon::now()->format('Y-m-d'),
            'shift_start'       => Carbon::now(),
            'start_balance'     => $request->input('startBalance'),
        ]);
        return $record;
    }
}
