<?php
namespace Organization\Actions\GateShift;
use Illuminate\Http\Request;
use Organization\Models\{
    GateShift
};
use Organization\Models\GateShiftAdmin;

class StoreAction
{
    public function execute(Request $request)
    {
        $record =  GateShift::create([
            'week_day_id'       => $request->input('day'),
            'gate_id'       => $request->input('gate'),
            //'description'       => $request->input('description'),
            'created_by'        => auth('organization_admin')->user()->id
        ]);

        foreach ($request->input('admins') as $admin)
        {
            GateShiftAdmin::create([
                'gate_shift_id' => $record->id,
                'organization_admin_id' => $admin
            ]);
        }
        return $record;
    }
}
