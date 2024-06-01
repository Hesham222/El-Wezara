<?php
namespace Organization\Actions\employeeVacationType;
use Illuminate\Http\Request;
use Organization\Models\{EmployeeVacationType};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  EmployeeVacationType::create([
            'type' => $request->input('name'),
            'description'      => $request->input('description'),
            'vacation_type' => $request->input('vacation_type'),
        ]);

    }
}
