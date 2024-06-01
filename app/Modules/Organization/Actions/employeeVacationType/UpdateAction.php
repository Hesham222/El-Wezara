<?php
namespace Organization\Actions\employeeVacationType;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeVacationType
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = EmployeeVacationType::find($id);
        $record->fill([
            'type' => $request->input('name'),
            'description'      => $request->input('description'),
            'vacation_type'      => $request->input('vacation_type'),
        ]);
        $record->save();
    }
}
