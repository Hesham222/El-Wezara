<?php
namespace Organization\Actions\EmployeeJob;
use Illuminate\Http\Request;
use Organization\Models\{
    EmployeeJob
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = EmployeeJob::find($id);
        $record->fill([
            'name' => $request->input('name'),
            'description'      => $request->input('description'),
            'Vacation_balance' => $request->input('Vacation_balance'),
        ]);
        $record->save();
    }
}
