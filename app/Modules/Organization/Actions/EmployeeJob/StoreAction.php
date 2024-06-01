<?php
namespace Organization\Actions\EmployeeJob;
use Illuminate\Http\Request;
use Organization\Models\{EmployeeJob};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  EmployeeJob::create([
            'name' => $request->input('name'),
            'description'      => $request->input('description'),
            'Vacation_balance' => $request->input('Vacation_balance'),
        ]);

    }
}
