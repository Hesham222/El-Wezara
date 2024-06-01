<?php
namespace Organization\Actions\Employee;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\{
    OrganizationAdmin,Employee
};
class StoreSalaryAction
{


    public function execute(Request $request): void
    {

        $record =  Employee::FindOrFail($request->id);
        $record->gross_salary       = $request->input('gross_salary');
        $record->annual_increase_rate      = $request->input('annual_increase_rate');
        $record->save();



    }
}
