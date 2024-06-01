<?php
namespace Organization\Actions\GateShift;
use Illuminate\Http\Request;
use Organization\Models\{
    GateShift
};
use Organization\Models\GateShiftAdmin;

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                    = GateShift::find($id);
        $record->week_day_id        = $request->input('day');
        $record->gate_id            = $request->input('gate');
        //$record->description       = $request->input('description');
        $record->save();

        if ($request->input('admins'))
        {
            $record->gateShiftAdmins()->delete();
            foreach ($request->input('admins') as $admin)
            {
                GateShiftAdmin::create([
                    'gate_shift_id' => $record->id,
                    'organization_admin_id' => $admin
                ]);
            }
        }
        return $record;
    }
}
